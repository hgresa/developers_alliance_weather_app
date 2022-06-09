<?php

namespace Tomadevall\WeatherApp\Model\Config;

class OpenWeather
{
    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return '092159fdd3a795cec6884bd3ec861633';
    }

    /**
     * @return string
     */
    public function getApiEndpoint(): string
    {
        return 'https://api.openweathermap.org/data/2.5';
    }
}
