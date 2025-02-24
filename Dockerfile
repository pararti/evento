FROM php:8.3-fpm

ARG UID=1000
ARG GID=1000

RUN apt-get update \
    && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        zip \
        unzip \
        curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mysqli zip opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
#RUN composer --version

RUN groupmod -g ${GID} www-data && \
    usermod -u ${UID} www-data && \
    usermod -u ${UID} -g ${GID} -aG ${GID} www-data && \
    usermod -s /bin/bash www-data

RUN chown www-data:www-data /var/www -R
USER www-data

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
