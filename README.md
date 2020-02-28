# Currencies Converter App
Project contains:
* REST Api for converting currencies on endpoint: /api/v1/convert
* Main page with example of fetching data from REST Api
  (tested only on modern browsers - chrome/firefox, better compatibility need to configure autoprefixer). 
* Docker containers:
    * webserver: nginx
    * db: mariadb
    * app: laravel app
    * phpmyadmin: phpmyadmin

## Requirements
1. Docker
1. Docker compose
1. Yarn/NPM
----

## Setup project:
#### Install project dependencies:
    $ docker run --rm -v $(pwd):/app composer install
#### Setup containers:
    $ docker-compose up -d

#### Setup laravel environment:
    .env configuration:
        DB_CONNECTION=mysql
        DB_HOST=db
        DB_PORT=3306
        DB_DATABASE=currency_calc_app
        DB_USERNAME=user
        DB_PASSWORD=test
    
    $ docker-compose exec app php artisan key:generate
    $ docker-compose exec app php artisan config:cache
----

## Set up database:
#### Migrations:
    $ docker-compose exec app php artisan migrate
#### Seeds:
    $ docker-compose exec app php artisan db:seed

----

## Set up front

#### Setup node_modules:
    $ yarn install 
    OR
    $ npm install

#### Build assets, scripts and styles (DEV)
    $ yarn dev

----

## Tests:
#### API Tests:
    $ docker-compose exec app vendor/bin/phpunit --group APITest

#### DB Tests:
    $ docker-compose exec app vendor/bin/phpunit --group DBTest

#### Frontend Tests:
    $ docker-compose exec app vendor/bin/phpunit --group Frontend

----

## Helpers:
#### Run commands on container with laravel app:
    $ docker-compose exec app php artisan COMMAND

----

## TODO:

- [ ] REST API Authentication by API_KEY and domain.
- [ ] Remove auto generated code from skeleton app like:
    * app\Http\Controllers\Auth
    * test Examples
- [ ] 'TODO' in code
- [ ] More DB tests
