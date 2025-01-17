# test-RailExpert

## Задание

<i>
Laravel

Завести новый проект. С помощью фабрики создать 10 пользователей. В контроллере отдавать список пользоватей и для сущности User добавить поле description, в которое выводить список навыков в разных комбинациях с использованием паттерна Декоратор (реализации применять рандомно).
Варианты навыков: ['php', 'js', 'golang', 'java']

Написать тестовый метод, который проверит, что контроллером отдается список пользователей с непустым массивом навыков

Vue/React

Сделать список пользователей с навыками. Добавить форму создания нового пользователя с валидацией имени (либо только цифры не более 12 символов, либо только буквы в обоих регистрах)

Полностью рабочее приложение не нужно. Я буду смотреть на код.

devops

На гитхабе создать репозиторий и в файле Readme.md  описать процесс деплоя сделанного приложения на компьютере, чтобы я мог его задеплоить
</i>

## Развертывание — вариант 1 — Docker:

Клонируйте проект:
````bash
git clone https://github.com/Valentin-Ivlev/test-RailExpert.git
````
перейдите в папку проекта:
````bash
cd test-RailExpert
````
соберите и запустите контейнеры:
````bash
docker-compose up -d --build
````
выполните скрипт настройки:
````bash
docker-compose exec app bash -c "chmod +x setup.sh && ./setup.sh"
````
проект доступен по адресу:
````bash
http://localhost:8000/
````
## Развертывание — вариант 2 — локальный web-сервер:
Клонируйте проект:
````bash
git clone https://github.com/Valentin-Ivlev/test-RailExpert.git
````
перейдите в папку проекта:
````bash
cd test-RailExpert
````
установите зависимости проекта:
```shell
composer install

npm install
```
соберите frontend:
```shell
npm run build
```
Сгенерируйте ключ приложения:
```shell
php artisan key:generate
```
настройете подключение к базе данных в файле `.env`

установите права на папки проекта:
```shell
chmod 755 -R [путь к папке проекта]/
chmod -R o+w [путь к папке проекта]/storage
```
настройте web-сервер, чтобы он указывал на папку `[путь к папке проекта]/public/

очистите проект:
```shell
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```
запустите миграции:
````bash
php artisan migrate --force
````
запустите сидер:
````bash
php artisan db:seed --force
````
## Тестирование:
Для запуска теста выполните:
````bash
php artisan test
````
