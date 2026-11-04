FROM php:8.4-apache
# habilita o PDO para MySQL
RUN docker-php-ext-install pdo pdo_mysql
# reescrita de URL (usaremos no Slim)
RUN a2enmod rewrite

