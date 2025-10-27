FROM php:8.2-fpm-alpine

# Outils (git/unzip/curl) + libs pour GD
RUN apk add --no-cache \
    git unzip curl \
    freetype-dev libjpeg-turbo-dev libpng-dev libwebp-dev

# Activer GD (jpeg/webp) + PDO MySQL
RUN docker-php-ext-configure gd \
      --with-freetype \
      --with-jpeg \
      --with-webp \
  && docker-php-ext-install -j$(nproc) gd pdo_mysql

# Installer Composer globalement
RUN php -r "copy('https://getcomposer.org/installer','/tmp/composer-setup.php');" \
 && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
 && rm /tmp/composer-setup.php

WORKDIR /var/www

# Les overrides PHP/FPM
COPY php.ini /usr/local/etc/php/conf.d/99-overrides.ini
COPY fpm-overrides.conf /usr/local/etc/php-fpm.d/zz-overrides.conf