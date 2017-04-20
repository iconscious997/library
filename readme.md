# Library

Is a simple book library web application written in Laravel framework, where you can store your books and organize them by tags, authors or publishers. If you have an account at Google you could also use Books API to get more information about your book by ISBN.

## Installation and requirements

This application has a few requirements which should be met to allow this application to work properly. First of all, it needs to be __PHP version 7.0__ on server where the application will be running, __MySQL or MariaDB__ and __allowed mode_overwrite__ in Apache2 or Http.D. It is also recommended to have installed composer or at least have it localy available.

### How to make it work

After you copy this application by extracting the zip from releases or cloning this repository, you'll need to copy the `.env.example` file and rename it to `.env`. You should put all configuration and connections to your database in this file. Then you can also use the `composer install` or `composer update` commands in bash to install all required dependencies. After a successfull installation of dependencies it's time to migrate application tables to your database, this can be done by using the `php artisan migrate` command in bash. If the migration was completed successfully, you can now visit the url where your application is located at and blank page with a title, search and user registration will welcome you!
## Licensing

This application is under [MIT License](license.md).