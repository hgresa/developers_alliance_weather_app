<?php

namespace Tomadevall\WeatherApp\Ui\DataProvider\WeatherHistoricalData\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Tomadevall\WeatherApp\Api\Data\OpenWeatherInterface;

class Collection extends SearchResult
{
    /**
     * @return void
     */
    protected function _initSelect(): void
    {
        $this->addFilterToMap(OpenWeatherInterface::ID, 'main_table.' . OpenWeatherInterface::ID);
        $this->addFilterToMap(OpenWeatherInterface::CITY, 'main_table.' . OpenWeatherInterface::CITY);
        $this->addFilterToMap(OpenWeatherInterface::COUNTRY, 'main_table.' . OpenWeatherInterface::COUNTRY);
        $this->addFilterToMap(OpenWeatherInterface::DESCRIPTION, 'main_table.' . OpenWeatherInterface::DESCRIPTION);
        $this->addFilterToMap(OpenWeatherInterface::TEMPERATURE, 'main_table.' . OpenWeatherInterface::TEMPERATURE);
        $this->addFilterToMap(OpenWeatherInterface::FEELS_LIKE, 'main_table.' . OpenWeatherInterface::FEELS_LIKE);
        $this->addFilterToMap(OpenWeatherInterface::PRESSURE, 'main_table.' . OpenWeatherInterface::PRESSURE);
        $this->addFilterToMap(OpenWeatherInterface::HUMIDITY, 'main_table.' . OpenWeatherInterface::HUMIDITY);
        $this->addFilterToMap(OpenWeatherInterface::WIND_SPEED, 'main_table.' . OpenWeatherInterface::WIND_SPEED);
        $this->addFilterToMap(OpenWeatherInterface::SUNRISE, 'main_table.' . OpenWeatherInterface::SUNRISE);
        $this->addFilterToMap(OpenWeatherInterface::SUNSET, 'main_table.' . OpenWeatherInterface::SUNSET);
        $this->addFilterToMap(OpenWeatherInterface::CREATED_AT, 'main_table.' . OpenWeatherInterface::CREATED_AT);
        parent::_initSelect();
    }
}
