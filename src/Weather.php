<?php

/*
 * This file is part of the mosagx/weather.
 *
 * (c) mosagx <mosagx@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Mosagx\Weather;

use GuzzleHttp\Client;
use Mosagx\Weather\Exceptions\HttpException;
use Mosagx\Weather\Exceptions\InvalidArgumentException;

class Weather
{
    protected $key;

    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions($options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * 获取实时天气.
     */
    public function getLiveWeather($city, $output = 'json')
    {
        return $this->getWeather($city, 'base', $output);
    }

    /**
     * 获取天气预报.
     */
    public function getForecastsWeather($city, $output = 'json')
    {
        return $this->getWeather($city, 'all', $output);
    }

    public function getWeather($city, $extensions = 'base', $output = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';
        if (!\in_array(\strtolower($output), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response output: '.$output);
        }

        if (!\in_array(\strtolower($extensions), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid extensions value(base/all): '.$extensions);
        }

        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'extensions' => \strtolower($extensions),
            'output' => \strtolower($output),
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();

            return 'json' === $output ? \json_decode($response, true) : $response;
        } catch (\Exception $th) {
            throw new HttpException($th->getMessage(), $th->getCode(), $th);
        }
    }
}
