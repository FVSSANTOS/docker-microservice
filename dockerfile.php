FROM php:8.2-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql


RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/*


RUN sed -i 's/listen = \/run\/php\/php8.2-fpm.sock/listen = 9000/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/;listen.owner = www-data/listen.owner = www-data/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/;listen.group = www-data/listen.group = www-data/' /usr/local/etc/php-fpm.d/www.conf


WORKDIR /var/www/html


RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
