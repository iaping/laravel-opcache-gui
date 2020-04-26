## Laravel Opcache Gui

![Screenshot](screenshot19111901.png)

在没找到好用的Laravel Opcache界面包而开发的

## INSTALL

composer
```php
php composer.phar require aping/laravel-opcache-gui
```
或
```php
"require": {
    "aping/laravel-opcache-gui": "dev-master"
}
```

## CONFIG

### Laravel 5.5+:

Add Service Provider to config/app.php in providers section
```bash
Aping\LaravelOpcacheGui\OpcacheServiceProvider::class,
```

Add a route in your web routes file
```php
Route::get('opcache', '\Aping\LaravelOpcacheGui\Controllers\OpcacheController@index');
```

Go to http://myapp/opcache or some other route

## TODO

- opcache flush & tests