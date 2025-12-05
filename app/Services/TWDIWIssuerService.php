<?php

namespace App\Services;

use App\Models\ApiLog;
use Illuminate\Support\Facades\Http;

/**
 * TW-DIW (Taiwan Digital Identity Wallet) Issuer Service
 *
 * 用於與 TW-DIW Issuer Sandbox API 互動，發行數位憑證 (VC)
 */
class TWDIWIssuerService
{
    protected string $baseUrl;
    protected string $accessToken;

    public function __construct()
    {
        $this->baseUrl = config('services.tw_diw.issuer_base_url', 'https://issuer-sandbox.wallet.gov.tw');
        $this->accessToken = config('services.tw_diw.issuer_token');
    }

    /**
     * 發行 VC - 產生 QR Code
     *
     * @param string $vcUid VC 模板 UID
     * @param array $fields 欄位資料 (key-value pairs)
     * @param string|null $issuanceDate 發行日期 (YYYYMMDD)
     * @param string|null $expiredDate 到期日期 (YYYYMMDD)
     * @return array
     * @throws \Exception
     */
    public function issueVC(
        string $vcUid,
        array $fields,
        ?string $issuanceDate = null,
        ?string $expiredDate = null
    ): array {
        // 轉換 fields 格式：{key: value} => [{ename: key, content: value}]
        $formattedFields = collect($fields)->map(function ($content, $ename) {
            return [
                'ename' => $ename,
                'content' => (string) $content,
            ];
        })->values()->toArray();

        $payload = [
            'vcUid' => $vcUid,
            'fields' => $formattedFields,
        ];

        if ($issuanceDate) {
            $payload['issuanceDate'] = $issuanceDate;
        }

        if ($expiredDate) {
            $payload['expiredDate'] = $expiredDate;
        }

        $endpoint = '/api/qrcode/data';
        $url = "{$this->baseUrl}{$endpoint}";
        $headers = [
            'Access-Token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ];

        $startTime = microtime(true);

        try {
            $response = Http::withHeaders($headers)->post($url, $payload);

            $duration = (int) ((microtime(true) - $startTime) * 1000);

            // 記錄 API Log
            ApiLog::logApiCall([
                'service' => 'issuer',
                'method' => 'POST',
                'endpoint' => $endpoint,
                'full_url' => $url,
                'request_headers' => $this->sanitizeHeaders($headers),
                'request_body' => $payload,
                'response_status' => $response->status(),
                'response_headers' => $response->headers(),
                'response_body' => $response->json(),
                'duration_ms' => $duration,
                'success' => $response->successful(),
                'error_message' => $response->failed() ? ($response->json()['message'] ?? $response->body()) : null,
                'transaction_id' => $response->json()['transactionId'] ?? null,
            ]);

            if ($response->failed()) {
                throw new \Exception(
                    'TW-DIW Issuer API 呼叫失敗: ' .
                    ($response->json()['message'] ?? $response->body())
                );
            }

            $data = $response->json();

            return [
                'transactionId' => $data['transactionId'] ?? null,
                'qrCode' => $data['qrCode'] ?? null,
                'deepLink' => $data['deepLink'] ?? null,
            ];
        } catch (\Exception $e) {
            $duration = (int) ((microtime(true) - $startTime) * 1000);

            // 記錄失敗的 API Log
            ApiLog::logApiCall([
                'service' => 'issuer',
                'method' => 'POST',
                'endpoint' => $endpoint,
                'full_url' => $url,
                'request_headers' => $this->sanitizeHeaders($headers),
                'request_body' => $payload,
                'response_status' => null,
                'response_headers' => null,
                'response_body' => null,
                'duration_ms' => $duration,
                'success' => false,
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * 查詢 VC 發行狀態
     *
     * @param string $transactionId 交易 ID
     * @return array
     * @throws \Exception
     */
    public function getVCStatus(string $transactionId): array
    {
        $endpoint = "/api/credential/nonce/{$transactionId}";
        $url = "{$this->baseUrl}{$endpoint}";
        $headers = [
            'Access-Token' => $this->accessToken,
        ];

        $startTime = microtime(true);

        try {
            $response = Http::withHeaders($headers)->get($url);

            $duration = (int) ((microtime(true) - $startTime) * 1000);

            // 記錄 API Log
            ApiLog::logApiCall([
                'service' => 'issuer',
                'method' => 'GET',
                'endpoint' => $endpoint,
                'full_url' => $url,
                'request_headers' => $this->sanitizeHeaders($headers),
                'request_body' => null,
                'response_status' => $response->status(),
                'response_headers' => $response->headers(),
                'response_body' => $response->json(),
                'duration_ms' => $duration,
                'success' => $response->successful(),
                'error_message' => $response->failed() ? ($response->json()['message'] ?? $response->body()) : null,
                'transaction_id' => $transactionId,
            ]);

            if ($response->failed()) {
                throw new \Exception(
                    '查詢 VC 狀態失敗: ' .
                    ($response->json()['message'] ?? $response->body())
                );
            }

            $data = $response->json();

            // 解析 JWT 並取得 CID 和 Holder DID (sub)
            $jwt = $data['credential'] ?? null;
            $cid = null;
            $holderDid = null;
            $jwtDecoded = null;

            if ($jwt) {
                $parts = explode('.', $jwt);
                if (count($parts) === 3) {
                    $header = json_decode(base64_decode(strtr($parts[0], '-_', '+/')), true);
                    $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);

                    // 從 JWT Payload 的 jti 欄位取得 cid（只取 UUID 部分）
                    $jti = $payload['jti'] ?? null;
                    if ($jti && preg_match('/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})$/i', $jti, $matches)) {
                        $cid = $matches[1];
                    } else {
                        $cid = $jti;
                    }

                    // 從 JWT Payload 的 sub 欄位取得 holder DID（接收者的 DID）
                    $holderDid = $payload['sub'] ?? null;

                    $jwtDecoded = [
                        'header' => $header,
                        'payload' => $payload,
                        'signature' => $parts[2],
                    ];
                }
            }

            return [
                'transactionId' => $transactionId,
                'cid' => $cid,
                'holderDid' => $holderDid,
                'jwt' => $jwt,
                'jwtDecoded' => $jwtDecoded,
                'credential' => $data,
            ];
        } catch (\Exception $e) {
            $duration = (int) ((microtime(true) - $startTime) * 1000);

            // 記錄失敗的 API Log
            ApiLog::logApiCall([
                'service' => 'issuer',
                'method' => 'GET',
                'endpoint' => $endpoint,
                'full_url' => $url,
                'request_headers' => $this->sanitizeHeaders($headers),
                'request_body' => null,
                'response_status' => null,
                'response_headers' => null,
                'response_body' => null,
                'duration_ms' => $duration,
                'success' => false,
                'error_message' => $e->getMessage(),
                'transaction_id' => $transactionId,
            ]);

            throw $e;
        }
    }

    /**
     * 變更 VC 狀態
     *
     * @param string $cid VC 的 CID
     * @param string $action 操作類型：revocation（撤銷）, suspension（停用）, recovery（復用）
     * @return array
     * @throws \Exception
     */
    public function changeVCStatus(string $cid, string $action): array
    {
        $validActions = ['revocation', 'suspension', 'recovery'];
        if (!in_array($action, $validActions)) {
            throw new \Exception("無效的操作類型：{$action}，目前支援 revocation, suspension, recovery");
        }

        $endpoint = "/api/credential/{$cid}/{$action}";
        $url = "{$this->baseUrl}{$endpoint}";
        $headers = [
            'Access-Token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ];

        $startTime = microtime(true);

        try {
            $response = Http::withHeaders($headers)->put($url, []);

            $duration = (int) ((microtime(true) - $startTime) * 1000);

            // 記錄 API Log
            ApiLog::logApiCall([
                'service' => 'issuer',
                'method' => 'PUT',
                'endpoint' => $endpoint,
                'full_url' => $url,
                'request_headers' => $this->sanitizeHeaders($headers),
                'request_body' => [],
                'response_status' => $response->status(),
                'response_headers' => $response->headers(),
                'response_body' => $response->json(),
                'duration_ms' => $duration,
                'success' => $response->successful(),
                'error_message' => $response->failed() ? ($response->json()['message'] ?? $response->body()) : null,
            ]);

            if ($response->failed()) {
                throw new \Exception(
                    "變更 VC 狀態失敗（{$action}）: " .
                    ($response->json()['message'] ?? $response->body())
                );
            }

            return $response->json();
        } catch (\Exception $e) {
            $duration = (int) ((microtime(true) - $startTime) * 1000);

            ApiLog::logApiCall([
                'service' => 'issuer',
                'method' => 'PUT',
                'endpoint' => $endpoint,
                'full_url' => $url,
                'request_headers' => $this->sanitizeHeaders($headers),
                'request_body' => [],
                'response_status' => null,
                'response_headers' => null,
                'response_body' => null,
                'duration_ms' => $duration,
                'success' => false,
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * 移除敏感資訊（如 Access-Token）
     */
    protected function sanitizeHeaders(array $headers): array
    {
        if (isset($headers['Access-Token'])) {
            $headers['Access-Token'] = '***REDACTED***';
        }
        return $headers;
    }
}
