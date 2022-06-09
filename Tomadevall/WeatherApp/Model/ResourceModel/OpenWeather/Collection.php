<?php

namespace Tomadevall\WeatherApp\Model\ResourceModel\OpenWeather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tomadevall\WeatherApp\Model\OpenWeather;
use Tomadevall\WeatherApp\Model\ResourceModel\OpenWeather as OpenWeatherResource;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(OpenWeather::class, OpenWeatherResource::class);
    }
}
