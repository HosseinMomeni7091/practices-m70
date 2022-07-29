# ![Laravel Example App]

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/HosseinMomeni7091/practices-m70.git

Switch to the repo folder

    cd Snappfood

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed


Link the storage 

    php artisan storage:link

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve
```


The api can be accessed at

    http://localhost:8000/api


Admin user and pass are as below: 

    Username: 
    hossein.momeni@yahoo.com

    Password:
    123


You can operate ready api by postman link as below:

    https://www.postman.com/laravel-maktab70/workspace/snappfood/collection/21676315-5b316c05-9253-4f11-95c6-d8528e0efa59?action=share&creator=21676315


