# Running Pure PHP Version of the Laravel Project

## Prerequisites
- PHP
- XAMPP

## Setup Prerequisites
```
PHP: https://www.php.net/manual/en/install.php
XAMPP: https://www.apachefriends.org/download.html
```
## Setup
- open XAMPP, run **Apache Web Server** and **MySQL Database**
- open browser
- enter **localhost/phpmyadmin/** to open database
- use **php_db.sql** to import database
- open terminal and go to your htdocs folder
```
cd <XAMPP directory>/htdocs
git clone https://github.com/jonahmarc/lamp-project.git`
cd lamp-project
git checkout php_dev
```
- inside **connection.php** file, setup database values for host, username, password, database (name)
## Run
- open browser
- enter **localhost/lamp_project/**

> [!NOTE]
> XAMPP displays the project by including the folder: localhost/project-folder-name