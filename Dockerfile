FROM php:8.0-fpm-alpine

# Set working directory
WORKDIR /var/www/imusic_api

# Install PHP Composer
RUN apk update && \
    apk upgrade && \
    apk add --update --no-cache autoconf tzdata mysql-client && \
    docker-php-ext-install pdo_mysql mysqli && \
    docker-php-ext-enable mysqli && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer &&\
    curl -s -O https://bin.equinox.io/c/4VmDzA7iaHb/ngrok-stable-linux-amd64.zip &&\
    unzip ngrok-stable-linux-amd64.zip &&\
    mv ngrok /usr/local/bin/ &&\
    rm -f ngrok-stable-linux-amd64.zip


# Copy existing application directory
COPY . .
COPY php.ini /usr/local/etc/php

# Change timezone to match
ENV TZ Asia/Ho_Chi_Minh
