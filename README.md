# restapi
RESTful api using slim framework 

### Usage

### Installation

1- import database from slimapp.sql

2- Edit config.php for your connection params

3- Install SlimPHP and dependencies using: 
``` sh
$ composer install
```
API Endpints
``` sh
$ GET /public/customers
$ GET /public/customer/{id}
$ POST /public/customer/add
$ PUT /public/customer/update/{id}
$ DELETE /public/customer/delete/{id}
```
