#!/bin/sh


echo "************** Installing laravel dependencies **************"
composer install --verbose

php artisan config:clear

if [ -e .env ]
then
    echo "************** Refreshing database **************"
    #  php artisan migrate:fresh --seed
else
    echo "************** Copiyng .env **************"
    cp .env.example .env
    # php artisan migrate:fresh --seed
fi

echo "************** Generating key and refreshing  **************"
php artisan key:generate
php artisan config:cache

echo "************** Your application is ready to use **************"
exec "$@"
