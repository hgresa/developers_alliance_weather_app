<?php

namespace Tomadevall\WeatherApp\Api\Data;

interface OpenWeatherInterface
{
    public const ID = 'id';
    public const CITY = 'city';
    public const COUNTRY = 'country';
    public const DESCRIPTION = 'description';
    public const TEMPERATURE = 'temperature';
    public const FEELS_LIKE = 'feels_like';
    public const PRESSURE = 'pressure';
    public const HUMIDITY = 'humidity';
    public const WIND_SPEED = 'wind_speed';
    public const SUNRISE = 'sunrise';
    public const SUNSET = 'sunset';
    public const CREATED_AT = 'created_at';

    /**
     * @return array|mixed|null
     */
    public function getId();

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param string $city
     * @return OpenWeatherInterface
     */
    public function setCity(string $city): OpenWeatherInterface;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @param string $country
     * @return OpenWeatherInterface
     */
    public function setCountry(string $country): OpenWeatherInterface;

    /**
     * @return string
     */
    public function getCountry(): string;

    /**
     * @param string $description
     * @return OpenWeatherInterface
     */
    public function setDescription(string $description): OpenWeatherInterface;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param float $temperature
     * @return OpenWeatherInterface
     */
    public function setTemperature(float $temperature): OpenWeatherInterface;

    /**
     * @return float
     */
    public function getTemperature(): float;

    /**
     * @param float $feelsLike
     * @return OpenWeatherInterface
     */
    public function setFeelsLike(float $feelsLike): OpenWeatherInterface;

    /**
     * @return float
     */
    public function getFeelsLike(): float;

    /**
     * @param int $pressure
     * @return OpenWeatherInterface
     */
    public function setPressure(int $pressure): OpenWeatherInterface;

    /**
     * @return int
     */
    public function getPressure(): int;

    /**
     * @param int $humidity
     * @return OpenWeatherInterface
     */
    public function setHumidity(int $humidity): OpenWeatherInterface;

    /**
     * @return int
     */
    public function getHumidity(): int;

    /**
     * @param float $windSpeed
     * @return OpenWeatherInterface
     */
    public function setWindSpeed(float $windSpeed): OpenWeatherInterface;

    /**
     * @return int
     */
    public function getWindSpeed(): int;

    /**
     * @param string $sunrise
     * @return OpenWeatherInterface
     */
    public function setSunrise(string $sunrise): OpenWeatherInterface;

    /**
     * @return string
     */
    public function getSunrise(): string;

    /**
     * @param string $sunset
     * @return OpenWeatherInterface
     */
    public function setSunset(string $sunset): OpenWeatherInterface;

    /**
     * @return string
     */
    public function getSunset(): string;
}
