#!/bin/bash

php artisan cache:clear
php artisan migrate

chmod -R 777 storage bootstrap/cache

php-fpm
