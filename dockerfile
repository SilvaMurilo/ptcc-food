FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql
