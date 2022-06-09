<?php

namespace Tomadevall\WeatherApp\Model;

use Magento\Framework\Model\AbstractModel;
use Tomadevall\WeatherApp\Api\Data\OpenWeatherInterface;

class OpenWeather extends AbstractModel implements OpenWeatherInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\OpenWeather::class);
    }

    /**
     * @return array|mixed|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }
    
    /**
     * @param string $city
     * @return OpenWeather
     */
    public function setCity(string $city): OpenWeather
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->getData(self::CITY);
    }

    /**
     * @param string $country
     * @return OpenWeather
     */
    public function setCountry(string $country): OpenWeather
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * @param string $description
     * @return OpenWeather
     */
    public function setDescription(string $description): OpenWeather
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @param float $temperature
     * @return OpenWeather
     */
    public function setTemperature(float $temperature): OpenWeather
    {
        return $this->setData(self::TEMPERATURE, $temperature);
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->getData(self::TEMPERATURE);
    }

    /**
     * @param float $feelsLike
     * @return OpenWeather
     */
    public function setFeelsLike(float $feelsLike): OpenWeather
    {
        return $this->setData(self::FEELS_LIKE, $feelsLike);
    }

    /**
     * @return float
     */
    public function getFeelsLike(): float
    {
        return $this->getData(self::FEELS_LIKE);
    }

    /**
     * @param int $pressure
     * @return OpenWeather
     */
    public function setPressure(int $pressure): OpenWeather
    {
        return $this->setData(self::PRESSURE, $pressure);
    }

    /**
     * @return int
     */
    public function getPressure(): int
    {
        return $this->getData(self::PRESSURE);
    }

    /**
     * @param int $humidity
     * @return OpenWeather
     */
    public function setHumidity(int $humidity): OpenWeather
    {
        return $this->setData(self::HUMIDITY, $humidity);
    }

    /**
     * @return int
     */
    public function getHumidity(): int
    {
        return $this->getData(self::HUMIDITY);
    }

    /**
     * @param float $windSpeed
     * @return OpenWeather
     */
    public function setWindSpeed(float $windSpeed): OpenWeather
    {
        return $this->setData(self::WIND_SPEED, $windSpeed);
    }

    /**
     * @return int
     */
    public function getWindSpeed(): int
    {
        return $this->getData(self::WIND_SPEED);
    }

    /**
     * @param string $sunrise
     * @return OpenWeather
     */
    public function setSunrise(string $sunrise): OpenWeather
    {
        return $this->setData(self::SUNRISE, $sunrise);
    }

    /**
     * @return string
     */
    public function getSunrise(): string
    {
        return $this->getData(self::SUNRISE);
    }

    /**
     * @param string $sunset
     * @return OpenWeather
     */
    public function setSunset(string $sunset): OpenWeather
    {
        return $this->setData(self::SUNSET, $sunset);
    }

    /**
     * @return string
     */
    public function getSunset(): string
    {
        return $this->getData(self::SUNSET);
    }
}
