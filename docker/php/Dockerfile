FROM php:8.3-fpm

# 必要パッケージ
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    nodejs \
    npm

# PHP拡張
RUN docker-php-ext-install pdo_mysql zip mbstring

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
