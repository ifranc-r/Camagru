FROM php:8.2-fpm-alpine

# Paquets nécessaires pour compiler GD avec JPEG/PNG/WebP
RUN apk add --no-cache \
    freetype-dev libjpeg-turbo-dev libpng-dev libwebp-dev

# Active GD avec support JPEG/WebP et ajoute pdo_mysql
RUN docker-php-ext-configure gd \
      --with-freetype \
      --with-jpeg \
      --with-webp \
  && docker-php-ext-install -j$(nproc) \
      gd pdo_mysql

WORKDIR /var/www

COPY php.ini /usr/local/etc/php/conf.d/99-overrides.ini