<?php

/**
 * Force .env file values to override system environment variables
 * This is needed when Herd or other services set environment variables
 * that conflict with .env settings
 *
 * Security Note: This file only processes the local .env file which is
 * under developer control. Input validation is applied to prevent
 * injection attacks from malformed .env files.
 */

$envFile = __DIR__ . '/../.env';

// 允許的環境變數鍵名白名單（僅允許英數字和底線）
$allowedKeyPattern = '/^[A-Z][A-Z0-9_]*$/';

// 允許覆蓋的環境變數白名單
// 只有這些鍵名可以被 .env 檔案覆蓋
$allowedKeys = [
    'APP_NAME',
    'APP_ENV',
    'APP_KEY',
    'APP_DEBUG',
    'APP_TIMEZONE',
    'APP_URL',
    'APP_LOCALE',
    'APP_FALLBACK_LOCALE',
    'APP_FAKER_LOCALE',
    'APP_MAINTENANCE_DRIVER',
    'BCRYPT_ROUNDS',
    'LOG_CHANNEL',
    'LOG_STACK',
    'LOG_DEPRECATIONS_CHANNEL',
    'LOG_LEVEL',
    'DB_CONNECTION',
    'DB_HOST',
    'DB_PORT',
    'DB_DATABASE',
    'DB_USERNAME',
    'DB_PASSWORD',
    'SESSION_DRIVER',
    'SESSION_LIFETIME',
    'SESSION_ENCRYPT',
    'SESSION_PATH',
    'SESSION_DOMAIN',
    'BROADCAST_CONNECTION',
    'FILESYSTEM_DISK',
    'QUEUE_CONNECTION',
    'CACHE_STORE',
    'CACHE_PREFIX',
    'MEMCACHED_HOST',
    'REDIS_CLIENT',
    'REDIS_HOST',
    'REDIS_PASSWORD',
    'REDIS_PORT',
    'MAIL_MAILER',
    'MAIL_SCHEME',
    'MAIL_HOST',
    'MAIL_PORT',
    'MAIL_USERNAME',
    'MAIL_PASSWORD',
    'MAIL_FROM_ADDRESS',
    'MAIL_FROM_NAME',
    'AWS_ACCESS_KEY_ID',
    'AWS_SECRET_ACCESS_KEY',
    'AWS_DEFAULT_REGION',
    'AWS_BUCKET',
    'AWS_USE_PATH_STYLE_ENDPOINT',
    'VITE_APP_NAME',
    'TW_DIW_ISSUER_SANDBOX_TOKEN',
    'TW_DIW_VERIFIER_SANDBOX_TOKEN',
    'SANCTUM_STATEFUL_DOMAINS',
];

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Skip comments and empty lines
        if (empty($line) || strpos(trim($line), '#') === 0) {
            continue;
        }

        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // 驗證鍵名格式（只允許大寫字母、數字和底線，且必須以字母開頭）
            if (!preg_match($allowedKeyPattern, $key)) {
                continue;
            }

            // 驗證鍵名是否在白名單中
            if (!in_array($key, $allowedKeys, true)) {
                continue;
            }

            // 驗證值的長度（防止過長的輸入）
            if (strlen($value) > 1000) {
                continue;
            }

            // Remove quotes from value
            if (preg_match('/^(["\'])(.*)\\1$/', $value, $matches)) {
                $value = $matches[2];
            }

            // 驗證值不包含換行符或 null 字元（防止注入攻擊）
            if (preg_match('/[\r\n\x00]/', $value)) {
                continue;
            }

            // Force override system environment variable
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}
