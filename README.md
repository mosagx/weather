<h1 align="center">Weather</h1>

[![Build Status](https://travis-ci.com/mosagx/weather.svg?branch=master)](https://travis-ci.com/mosagx/weather)

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

        // live weather data
        $live_data = $weather->getLiveWeather($request->input('city', '北京'));

        // forecasts weather data
        $forecasts_data = $weather->getForecastsWeather($request->input('city', '北京'));
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

// live weather data
$live_data = $weather->getLiveWeather('北京');

// forecasts weather data
$forecasts_data = $weather->getForecastsWeather('北京');

```
