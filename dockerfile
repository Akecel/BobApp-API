FROM php:7.2
MAINTAINER Hyra

RUN docker-php-ext-install pdo pdo_mysql