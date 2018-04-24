# Laravel Support Ticket System

A ticket system to manage support with Laravel 5.6

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

```bash
$ git clone https://github.com/NuBOXDevCom/laravel56-support-tickets.git
```

### Installing for development environment

```bash
$ cd laravel-56-support-tickets
$ composer install
```

**Set your credentials and parameters to .env file**

And install database

```bash
$ php artisan migrate --seed
```
Start Built in server
```bash
$ php artisan serve
```
and finally, get to
```
http://localhost:8000
```

## Built With

* [Laravel](https://laravel.com) - Laravel 5.6 framework
* [Twitter Bootstrap](http://www.getbootstrap.com) - Used to render friendly view
* [Font-Awesome](http://www.fontawesome.io) - Used for icons font

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details