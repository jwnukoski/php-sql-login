# php-sql-login
A basic boilerplate for a PHP / SQL user login and registration.  
This project is still in its very early stages.  
![Preview of php-sql-login](https://github.com/jwnukoski/php-sql-login/blob/main/screenshot.png?raw=true "php-sql-login Demo")  

## Goal
No third-party apps, just standard PHP session authentication, which can be edited further.  
This project is kept as light as possible, so that it can be used in many places.      

## Hashing
Hashes created with PHP's password_verify default algorithm.  

## Connections
SQL connections are connected with PDO and prepared statements.  
These queries will be moved to stored procedures after testing.  

## Requirements
Requires PHP 5 >= 5.1.2  
