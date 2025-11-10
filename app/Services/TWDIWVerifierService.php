<?php

namespace App\Services;

use App\Models\VPVerificationResult;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

/**
 * TW-DIW (Taiwan Digital Identity Wallet) Verifier Service
 *
 * 用於與 TW-DIW Verifier Sandbox API 互動，驗證數位簡報 (VP)
 */
class TWDIWVerifierService
{
    protected string $baseUrl;
    protected string $accessToken;

    public function __construct()
    {
        $this->baseUrl = config('services.tw_diw.verifier_base_url', 'https://verifier-sandbox.wallet.gov.tw');
        $this->accessToken = config('services.tw_diw.verifier_token');
    }

    /**
     * 產生 VP 驗證 QR Code
     *
     * @param string $ref 驗證服務代碼
     * @param string $transactionId 交易 ID (建議使用 UUID v4)
     * @return array
     * @throws \Exception
     */
    public function generateVPQRCode(string $ref, string $transactionId): array
    {
        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
        ])->get("{$this->baseUrl}/api/oidvp/qrcode", [
            'ref' => $ref,
            'transactionId' => $transactionId,
        ]);

        if ($response->failed()) {
            throw new \Exception(
                'TW-DIW Verifier API 呼叫失敗: ' .
                ($response->json()['message'] ?? $response->body())
            );
        }

        $data = $response->json();

        return [
            'transactionId' => $transactionId,
            'qrCode' => $data['qrcodeImage'] ?? null,
            'authUri' => $data['authUri'] ?? null,
        ];
    }

    /**
     * 查詢 VP 驗證結果並保存到資料庫
     *
     * 注意：TW-DIW 在查詢一次後會刪除資料，因此必須立即保存
     *
     * @param string $transactionId 交易 ID
     * @return array|null 如果還沒有驗證結果則回傳 null
     * @throws \Exception
     */
    public function getVPResult(string $transactionId): ?array
    {
        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/api/oidvp/result", [
            'transactionId' => $transactionId,
        ]);

        if ($response->failed()) {
            $error = $response->json();

            // 如果是「verify result not found」，表示用戶還沒完成驗證，回傳 null
            if (isset($error['params'])) {
                $params = is_string($error['params']) ? json_decode($error['params'], true) : $error['params'];
                if (isset($params['message']) && $params['message'] === 'verify result not found') {
                    return null;
                }
            }

            // 其他錯誤才拋出異常
            throw new \Exception(
                '查詢 VP 驗證結果失敗: ' .
                ($error['message'] ?? $response->body())
            );
        }

        $data = $response->json();

        // 保存到資料庫（TW-DIW 查詢一次後會刪除資料）
        VPVerificationResult::updateOrCreate(
            ['transaction_id' => $transactionId],
            [
                'verify_result' => $data['verifyResult'] ?? false,
                'result_description' => $data['resultDescription'] ?? null,
                'credentials' => $data['data'] ?? [],
                'full_response' => $data,
                'verified_at' => Carbon::now(),
            ]
        );

        return [
            'verifyResult' => $data['verifyResult'] ?? null,
            'resultDescription' => $data['resultDescription'] ?? null,
            'data' => $data['data'] ?? null,
            'fullResponse' => $data,
        ];
    }

    /**
     * 從資料庫取得已保存的 VP 驗證結果
     *
     * @param string $transactionId 交易 ID
     * @return array|null
     */
    public function getStoredVPResult(string $transactionId): ?array
    {
        $result = VPVerificationResult::where('transaction_id', $transactionId)->first();

        if (!$result) {
            return null;
        }

        return [
            'verifyResult' => $result->verify_result,
            'resultDescription' => $result->result_description,
            'data' => $result->credentials,
            'fullResponse' => $result->full_response,
            'isUsed' => $result->is_used,
        ];
    }

    /**
     * 標記 VP 驗證結果為已使用
     *
     * @param string $transactionId 交易 ID
     * @return void
     */
    public function markVPResultAsUsed(string $transactionId): void
    {
        VPVerificationResult::where('transaction_id', $transactionId)
            ->update(['is_used' => true]);
    }
}
