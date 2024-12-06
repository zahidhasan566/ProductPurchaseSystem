<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Product Purchase System

A Simple Product Purchase System Implemented Here. 

## System Architecture

- Laravel Version 10.x
- php 8.1
- MySql
- Repository Pattern For Database Interaction
- PSR Maintained



## Features
- User Authentication
- Product Management
- Order Management
- Payment Gateway Integration
- RESTful API
- PHPUnit Testing

## Installation

```
composer install
```
-If php version mismatch, please use this one
```
composer install --ignore-platform-reqs
```

Migration: After successfully installing composer package, please use this code
```
php artisan migrate
```

Seeder: For seeding demo data
```
php artisan db:seed
```
## Api Checking
- Postman collection has been shared.
- Folder location : ProjectDirectory/postmanCollection/pm.postman_collection

NB: For security and github restriction purpose, stripe secret api and key could not provide. 

## Unit Testing
```
php artisan test
```

- Testing env added to the project (Additional)
- NB : Payment Confirmation Test will be failed due to secret key and api
