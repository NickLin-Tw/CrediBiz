#!/bin/sh
set -e

echo "等待資料庫連線..."
until php artisan db:show > /dev/null 2>&1; do
    echo "資料庫尚未就緒，等待中..."
    sleep 2
done

echo "執行資料庫遷移..."
php artisan migrate --force

echo "清除快取..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "啟動服務..."
exec "$@"
