# Running Project

## Prerequisites
- PHP
- Composer
- XAMPP

## Setup Prerequisites
```
Composer (& PHP): https://getcomposer.org/download/
XAMPP: https://www.apachefriends.org/download.html
```
## Run Local
- open XAMPP, run **Apache Web Server** and **MySQL Database**
- open terminal and go to your directory where the project will be saved
```
git clone https://github.com/jonahmarc/lamp-project.git`
cd lamp-project
```
- create and configure **.env** file (*https://github.com/platformsh-templates/laravel/blob/master/.env.example*)

`composer install`

`php composer.phar install`
```
php artisan key:generate
php artisan migrate
php artisan serve
```

- View application at given server address or localhost