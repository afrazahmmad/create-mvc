# Laravel 5 package to create MVC.
Laravel 5 Package to create model, controller, request and migration in single command.
## Requirements

This package requires PHP 7 and Laravel 5.4 or higher.

## Install through composer

``` bash
composer require afrazahmad/create-mvc
```
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
AfrazAhmad\MVC\MVCServiceProvider::class,
```
## Usage

To use this package, just run below command and you will be prompted to options where you can choose according to requirement.
 
``` bash
php artisan create:mvc
```




## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
