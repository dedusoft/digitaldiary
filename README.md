# digital diary web app made with PHP, CodeIgniter 4 JQuery, AJAX
## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library


## Installation Procedure

1 - Clone this project locally using the commmand

```git
git clone https://github.com/duclairdeugoue/digitaldiary.git 
```

2 - Enter inside the project folder and create an empty folder named `cache` inside the folder writable if not exist

3 - Type the commands below to upgrade and install the project packages:

```php
composer update

composer install 
```

4 - Create your own branch to 'branch-name' using the command:

```bash
git checkout -b [branch-name]
```

5 - Open your phpMyAdmin in XAMPP, WAMPP or MAMP and and create a db named `digitaldiary_db` , make sure your user is `root` and his password is  `root` by creating this user and granting all permission or else you can change the user in the `.env` file of the project.

6 - Go back to your IDE open the project  and type the command below to apply migrate the migrations

```php
php spark migrate
```

7 - Finally launch the application using the command

```php
php spark serve
```

## Documentation