#!/bin/sh

echo "************** Installing laravel dependencies **************"
    composer clear-cache
    composer install --verbose

    php artisan config:clear

echo "************** Cleaning Files **************"
    rm -rf storage/uploads

echo "************** Creating simbolic link to storage **************"
    php artisan storage:link

echo "************** Creating .env **************"
    rm -f -- .env
    cp .env.example .env
    # IP_ADDR=$(ifconfig en0 | grep inet | grep -v inet6 | awk '{print $2}')

    # sed -i -e "s|DB_HOST=127.0.0.1|DB_HOST=$IP_ADDR|g" .env
    rm -f -- .env-e

echo "************** Refreshing database **************"
    php artisan migrate:fresh --seed

echo "************** Generating key and refreshing  **************"
    php artisan key:generate
    php artisan config:cache

echo "************** Your application is ready to use **************"
exec "$@"
