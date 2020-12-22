<h1 align="center">Weather</h1>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>

## About project
Composer package based on amap API weather module.
- Simple interface for building query strings - [guzzle docs](https://docs.guzzlephp.org/en/stable/#).
- [amap docs](https://lbs.amap.com/api/webservice/guide/api/georegeo)

## Install
```
composer require mosagx/weather:dev-master
```

## Laravel use
### config
publish config file
```
php artisan vendor:publish --tag=mosagx amap-config
```
env config
```
AMAP_WEATHER_KEY= // your develop key
```
### use
```php
<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Mosagx\Weather\Weather;

class Controller extends BaseController
{
    public function test(Request $request, Weather $weather)
    {
        return $weather->getWeather($request->input('city', '北京'));
    }
}
```


## Other use
```php
<?php

require __DIR__.'/vendor/autoload.php';

use Mosagx\Weather\Weather;

$key = 'xx'; // your amap weather application key

$weather = new Weather($key);

$data = $weather->getWeather('北京');

```
