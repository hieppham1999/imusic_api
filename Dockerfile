FROM php:8.0-fpm-alpine

# Set working directory
WORKDIR /var/www/imusic_api

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory
COPY . .

RUN chgrp -R www-data storage 
