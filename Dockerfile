FROM php:7.2-apache

RUN apt-get update && apt-get install -y

RUN docker-php-ext-install mysqli pdo_mysql

RUN mkdir /app \
 && mkdir /app/test \
 && mkdir /app/test/www

COPY index.php /app/test/www/index.php
COPY add.html /app/test/www/add.html
RUN cp -r /app/test/www/* /var/www/html/.
