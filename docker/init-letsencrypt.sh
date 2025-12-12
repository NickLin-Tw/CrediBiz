#!/bin/bash

# Let's Encrypt 初始化腳本
# 使用方法: ./docker/init-letsencrypt.sh your-domain.com your-email@example.com

if [ -z "$1" ] || [ -z "$2" ]; then
    echo "使用方法: $0 <domain> <email>"
    echo "範例: $0 credibiz.example.com admin@example.com"
    exit 1
fi

DOMAIN=$1
EMAIL=$2
DATA_PATH="./certbot"
STAGING=0  # 設為 1 使用測試環境（有 rate limit）

echo "### 正在為 $DOMAIN 設定 Let's Encrypt SSL 憑證"

# 建立必要目錄
if [ ! -e "$DATA_PATH/conf/options-ssl-nginx.conf" ] || [ ! -e "$DATA_PATH/conf/ssl-dhparams.pem" ]; then
    echo "### 下載 TLS 參數..."
    mkdir -p "$DATA_PATH/conf"
    curl -s https://raw.githubusercontent.com/certbot/certbot/master/certbot-nginx/certbot_nginx/_internal/tls_configs/options-ssl-nginx.conf > "$DATA_PATH/conf/options-ssl-nginx.conf"
    curl -s https://raw.githubusercontent.com/certbot/certbot/master/certbot/certbot/ssl-dhparams.pem > "$DATA_PATH/conf/ssl-dhparams.pem"
    echo
fi

# 建立假憑證以啟動 Nginx
echo "### 建立假憑證供初始化使用..."
CERT_PATH="/etc/letsencrypt/live/$DOMAIN"
mkdir -p "$DATA_PATH/conf/live/$DOMAIN"
docker-compose run --rm --entrypoint "\
  openssl req -x509 -nodes -newkey rsa:4096 -days 1\
    -keyout '$CERT_PATH/privkey.pem' \
    -out '$CERT_PATH/fullchain.pem' \
    -subj '/CN=localhost'" certbot
echo

# 啟動 Nginx
echo "### 啟動 Nginx..."
docker-compose up --force-recreate -d nginx
echo

# 刪除假憑證
echo "### 刪除假憑證..."
docker-compose run --rm --entrypoint "\
  rm -Rf /etc/letsencrypt/live/$DOMAIN && \
  rm -Rf /etc/letsencrypt/archive/$DOMAIN && \
  rm -Rf /etc/letsencrypt/renewal/$DOMAIN.conf" certbot
echo

# 申請真實憑證
echo "### 申請 Let's Encrypt 憑證..."
STAGING_ARG=""
if [ $STAGING != "0" ]; then
    STAGING_ARG="--staging"
fi

docker-compose run --rm --entrypoint "\
  certbot certonly --webroot -w /var/www/certbot \
    $STAGING_ARG \
    -d $DOMAIN \
    --email $EMAIL \
    --rsa-key-size 4096 \
    --agree-tos \
    --no-eff-email \
    --force-renewal" certbot
echo

# 重新載入 Nginx
echo "### 重新載入 Nginx..."
docker-compose exec nginx nginx -s reload

echo "### 完成！SSL 憑證已成功設定"
