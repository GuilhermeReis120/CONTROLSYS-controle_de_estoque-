FROM php:8.2-apache

COPY . /var/www/html/

WORKDIR /var/www/html/

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80