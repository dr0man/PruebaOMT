Prueba OMT - Symfony
========================

This application has a hybrid behavior, it works as a web application and API REST.
This application is based on ["Symfony Demo Application"][6] and is a reference 
application created to show how to develop applications following the [Symfony Best Practices][1].

Requirements
------------

  * PHP 7.3 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

[Download zip file][5] or clone this repo and install 
the dependencies with Composer. 

```bash
# make Composer install the project's dependencies into vendor
cd my-project/
composer install
```

Usage
-----

There's no need to configure anything to run the application. If you have
[installed Symfony][4] binary, run this command:

```bash
$ cd my_project/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][3] like Nginx or
Apache to run the application.

For more documentation [Click Here.][7]
You can acces API REST Web Services using the following:

To list all users using GET method: <br/>
http://localhost:8000/api/users <br/>

<p align="center">
<a href="javascript:;"><img src="https://raw.githubusercontent.com/dr0man/PruebaOMT/main/public/img/WSAllUsers.jpg" alt="list all users" width="800px" height="400" /></a>
</p>

To add new user using POST method: <br/>
http://localhost:8000/api/add/user

<p align="center">
<a href="javascript:;"><img src="https://raw.githubusercontent.com/dr0man/PruebaOMT/main/public/img/WSAddUser.jpg" alt="Add new user" width="800px" height="400" /></a>
</p>

To update the information of the fourth registered user using the PUT method: <br/>
http://localhost:8000/api/user/4

<p align="center">
<a href="javascript:;"><img src="https://raw.githubusercontent.com/dr0man/PruebaOMT/main/public/img/WSUpdateUser.jpg" alt="Update user" width="800px" height="400" /></a>
</p>

To delete the fourth registered user using the DELETE method: <br/>
http://localhost:8000/api/user/4

<p align="center">
<a href="javascript:;"><img src="https://raw.githubusercontent.com/dr0man/PruebaOMT/main/public/img/WSDeleteUser.jpg" alt="delete" width="800px" height="400" /></a>
</p>

Tests
-----

Execute this command to run tests:

```bash
$ cd my_project/
$ ./bin/phpunit
```

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://github.com/dr0man/PruebaOMT/archive/refs/heads/main.zip
[6]: https://github.com/symfony/demo
[7]: https://github.com/dr0man/PruebaOMT/blob/main/public/uploads/Documentacion.pdf
