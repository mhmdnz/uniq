#!/bin/bash

cd /var/www/html
sh -c "composer install"
sh -c "php artisan migrate"
#sh -c "php artisan db:seed"

exec "$@"
