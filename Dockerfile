FROM php:5.6-apache

RUN apt-get update && apt-get install -y libssl-dev && rm -rf /var/lib/apt/lists/* && pecl install mongo && docker-php-ext-enable mongo

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN chown -R www-data:www-data /var/www/html/
RUN a2enmod headers && a2enmod rewrite
