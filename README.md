# KataWiki

# Getting started

## Installation

Switch to the repo folder

    cd KataWiki

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new Passport authentication secret key

    php artisan passport:intsall

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Active the folder sync and let public the user avatars

    php artisan storage:link

Start the local development server

    php artisan serve
    

You can now access the server at http://localhost:8000


If you want real time testing you have to do these steps :

Put your pusher credentials in .env

Install beyondcode/laravel-websockets

    composer require beyondcode/laravel-websockets
    
Publish the configuration file

    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider"
    
Migrate the database

    php artisan migrate
    
Start the WebSockets server

    php artisan websockets:serve
    
Make sure about configuration of comfig/app , config/broadcast and config/websockets

You can monitor Events using WebSocket's dashboard 

You can now access the dashboard at http://localhost:8000/laravel-websockets


Check the postman collection
