FROM php:7.4-fpm

# Don´t clear environment variables
# https://www.php.net/manual/en/install.fpm.configuration.php#clear-env
RUN echo "clear_env = no" >> /usr/local/etc/php-fpm.d/www.conf

RUN apt-get update -y \
    && apt-get install -y \
    nano \
    && docker-php-ext-install pdo_mysql

COPY . /var/www/html/
WORKDIR /var/www/html

ENTRYPOINT ["./build/php/start.sh"]
