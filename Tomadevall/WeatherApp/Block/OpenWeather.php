<?php

namespace Tomadevall\WeatherApp\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Request\DataPersistorInterface;
use Tomadevall\WeatherApp\Api\Data\OpenWeatherInterface;
use Tomadevall\WeatherApp\Model\ResourceModel\OpenWeather\Collection;
use Tomadevall\WeatherApp\Model\ResourceModel\OpenWeather\CollectionFactory;
use Tomadevall\WeatherApp\Model\ResourceModel\OpenWeather as OpenWeatherResource;
use Tomadevall\WeatherApp\Model\Url;

class OpenWeather extends Template
{
    protected DataPersistorInterface $dataPersistor;

    protected CollectionFactory $openWeatherCollectionFactory;

    protected OpenWeatherResource $openWeatherResource;

    protected Url $url;

    /**
     * @param Template\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param CollectionFactory $openWeatherCollectionFactory
     * @param OpenWeatherResource $openWeatherResource
     * @param array $data
     */
    public function __construct(
        Template\Context       $context,
        DataPersistorInterface $dataPersistor,
        CollectionFactory      $openWeatherCollectionFactory,
        OpenWeatherResource    $openWeatherResource,
        Url                    $url,
        array                  $data = []
    )
    {
        parent::__construct($context, $data);
        $this->dataPersistor = $dataPersistor;
        $this->openWeatherCollectionFactory = $openWeatherCollectionFactory;
        $this->openWeatherResource = $openWeatherResource;
        $this->url = $url;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    private function getDataPersistorItem(string $key)
    {
        $value = $this->dataPersistor->get($key);

        if ($value) {
            $this->dataPersistor->clear($key);

            return $value;
        }

        return null;
    }

    /**
     * @return mixed|null
     */
    public function getCountry()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::COUNTRY);
    }

    /**
     * @return mixed|null
     */
    public function getSunrise()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::SUNRISE);
    }

    /**
     * @return mixed|null
     */
    public function getSunset()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::SUNSET);
    }

    /**
     * @return mixed|null
     */
    public function getTemperature()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::TEMPERATURE);
    }

    /**
     * @return mixed|null
     */
    public function getFeelsLike()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::FEELS_LIKE);
    }

    /**
     * @return mixed|null
     */
    public function getPressure()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::PRESSURE);
    }

    /**
     * @return mixed|null
     */
    public function getHumidity()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::HUMIDITY);
    }

    /**
     * @return mixed|null
     */
    public function getWindSpeed()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::WIND_SPEED);
    }

    /**
     * @return mixed|null
     */
    public function getCity()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::CITY);
    }

    /**
     * @return mixed|null
     */
    public function getDescription()
    {
        return $this->getDataPersistorItem(OpenWeatherInterface::DESCRIPTION);
    }

    /**
     * @return Collection
     */
    public function getHistoricalData(): Collection
    {
        return $this->openWeatherCollectionFactory->create();
    }

    /**
     * @return array|null
     */
    public function getTableTitles(): ?array
    {
        return $this->openWeatherResource->getFields();
    }

    public function getPostActionUrl(): string
    {
        return $this->url->getWeatherPostUrl();
    }
}
