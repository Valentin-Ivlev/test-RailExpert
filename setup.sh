#!/bin/bash

composer install

npm install

npm run build

until php artisan db:check; do
  echo "Ожидание запуска базы данных..."
  sleep 2
done

php artisan key:generate

php artisan config:clear

php artisan migrate --force

php artisan db:seed --force

echo "Настройка завершена!"
