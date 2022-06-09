<?php

namespace Tomadevall\WeatherApp\Api;

use Tomadevall\WeatherApp\Api\Data\OpenWeatherInterface;

interface OpenWeatherRepositoryInterface
{
    /**
     * @param OpenWeatherInterface $openWeather
     * @return void
     */
    public function save(OpenWeatherInterface $openWeather): void;

    /**
     * @param int $id
     * @return OpenWeatherInterface
     */
    public function get(int $id): OpenWeatherInterface;

    /**
     * @param OpenWeatherInterface $openWeather
     * @return void
     */
    public function delete(OpenWeatherInterface $openWeather): void;

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void;
}
