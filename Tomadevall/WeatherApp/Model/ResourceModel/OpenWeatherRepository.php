<?php

namespace Tomadevall\WeatherApp\Model\ResourceModel;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Tomadevall\WeatherApp\Api\Data\OpenWeatherInterface;
use Tomadevall\WeatherApp\Api\OpenWeatherRepositoryInterface;
use Tomadevall\WeatherApp\Model\OpenWeatherFactory;
use Tomadevall\WeatherApp\Model\OpenWeather;
use Tomadevall\WeatherApp\Model\ResourceModel\OpenWeather as OpenWeatherResource;
use Psr\Log\LoggerInterface;

class OpenWeatherRepository implements OpenWeatherRepositoryInterface
{
    protected OpenWeatherResource $openWeatherResource;

    protected OpenWeatherFactory $openWeatherFactory;

    protected LoggerInterface $logger;

    public function __construct(
        OpenWeatherResource $openWeatherResource,
        OpenWeatherFactory  $openWeatherFactory,
        LoggerInterface     $logger
    )
    {
        $this->openWeatherResource = $openWeatherResource;
        $this->openWeatherFactory = $openWeatherFactory;
        $this->logger = $logger;
    }

    /**
     * @param OpenWeatherInterface $openWeather
     * @return void
     */
    public function save(OpenWeatherInterface $openWeather): void
    {
        try {
            $this->openWeatherResource->save($openWeather);
        } catch (AlreadyExistsException|Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return OpenWeather
     */
    public function get(int $id): OpenWeather
    {
        $openWeather = $this->openWeatherFactory->create();
        return $this->openWeatherResource->load($openWeather, $id, 'id');
    }

    /**
     * @param OpenWeatherInterface $openWeather
     * @return void
     */
    public function delete(OpenWeatherInterface $openWeather): void
    {
        try {
            $this->openWeatherResource->delete($openWeather);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        $openWeather = $this->get($id);
        $this->delete($openWeather);
    }
}
