FROM php:7.4-apache

#WORKDIR /var/www/html

WORKDIR /var/www/html
#COPY . /var/www/html/HiveGame

RUN apt-get update -y && apt-get install -y libmariadb-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN chmod -R 755 /var/www/html

