# 多階段建置 Dockerfile for Laravel + Vue3 + Vuetify

# ============================================
# Stage 1: 建置前端資源
# ============================================
FROM node:20-alpine AS frontend-builder

WORKDIR /app

# 複製 package.json 和 package-lock.json
COPY package*.json ./

# 安裝 npm 依賴
RUN npm ci

# 複製前端相關檔案
COPY resources/ ./resources/
COPY vite.config.js ./
COPY tailwind.config.js* ./

# 建置前端資源
RUN npm run build

# ============================================
# Stage 2: PHP 應用程式
# ============================================
FROM php:8.5-fpm-alpine

# 設定工作目錄
WORKDIR /var/www/html

# 安裝系統依賴與 PHP 擴充套件
RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
    supervisor \
    && docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    zip \
    opcache

# 安裝 Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 複製 composer 檔案
COPY composer.json composer.lock ./

# 安裝 PHP 依賴（不包含 dev 依賴）
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# 複製應用程式檔案
COPY . .

# 從前端建置階段複製編譯好的資源
COPY --from=frontend-builder /app/public/build ./public/build

# 設定權限
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 複製 Nginx 設定
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/http.d/default.conf

# 複製 Supervisor 設定
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# 複製 PHP-FPM 設定
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# 複製啟動腳本
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# 暴露 80 埠
EXPOSE 80

# 使用 supervisor 管理多個服務
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
