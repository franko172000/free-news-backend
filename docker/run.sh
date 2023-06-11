#!/usr/bin/env bash
cd /usr/src/app
composer install
php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0 --port=$APP_PORT
