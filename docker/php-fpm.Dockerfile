FROM php:8.1.7-fpm-bullseye

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y libonig-dev libpng-dev libjpeg-dev git vim libzip-dev zip \
    && apt-get clean

RUN docker-php-ext-install pdo_mysql mbstring zip gd opcache
RUN chown www-data:www-data /var/www

RUN ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY docker/php-fpm.ini /usr/local/etc/php/conf.d/zzz-php-fpm.ini
RUN sed -ri 's#^access.log *=*.*$#access.log = /app/storage/logs/php-fpm.log#' /usr/local/etc/php-fpm.d/docker.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
