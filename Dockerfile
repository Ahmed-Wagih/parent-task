FROM php:8.1

COPY . /var/www/html/

RUN composer install

EXPOSE 8000