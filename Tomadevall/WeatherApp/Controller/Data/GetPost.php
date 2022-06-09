<?php

namespace Tomadevall\WeatherApp\Controller\Data;

use JsonException;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Message\ManagerInterface;
use Tomadevall\WeatherApp\Api\Data\OpenWeatherInterface as OPI;
use Tomadevall\WeatherApp\Api\OpenWeatherRepositoryInterface;
use Tomadevall\WeatherApp\Model\Config\OpenWeather;
use Tomadevall\WeatherApp\Model\OpenWeatherFactory;

class GetPost implements HttpPostActionInterface
{
    protected OpenWeather $config;

    protected Curl $curl;

    protected DataPersistorInterface $dataPersistor;

    protected RedirectFactory $redirectFactory;

    protected Http $request;

    protected OpenWeatherFactory $openWeatherFactory;

    protected OpenWeatherRepositoryInterface $openWeatherRepository;

    protected ManagerInterface $messageManager;

    public function __construct(
        OpenWeather                    $config,
        Curl                           $curl,
        DataPersistorInterface         $dataPersistor,
        RedirectFactory                $redirectFactory,
        Http                           $request,
        OpenWeatherFactory             $openWeatherFactory,
        OpenWeatherRepositoryInterface $openWeatherRepository,
        ManagerInterface               $messageManager
    )
    {
        $this->config = $config;
        $this->curl = $curl;
        $this->dataPersistor = $dataPersistor;
        $this->redirectFactory = $redirectFactory;
        $this->request = $request;
        $this->openWeatherFactory = $openWeatherFactory;
        $this->openWeatherRepository = $openWeatherRepository;
        $this->messageManager = $messageManager;
    }

    /**
     * @param string $city
     * @return mixed
     * @throws JsonException
     */
    public function getWeatherData(string $city)
    {
        $apiKey = $this->config->getApiKey();
        $apiEndpoint = $this->config->getApiEndpoint();
        $url = "$apiEndpoint/weather?q=$city&appid=$apiKey&units=metric";

        $this->curl->get($url);

        return json_decode($this->curl->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param array $apiResult
     * @return array
     */
    public function extractWeatherData(array $apiResult): array
    {
        $temperatureData = $apiResult['main'];
        $sysData = $apiResult['sys'];

        return [
            OPI::COUNTRY => $sysData['country'],
            OPI::SUNRISE => $sysData['sunrise'],
            OPI::SUNSET => $sysData['sunset'],
            OPI::TEMPERATURE => $temperatureData['temp'],
            OPI::FEELS_LIKE => $temperatureData['feels_like'],
            OPI::PRESSURE => $temperatureData['pressure'],
            OPI::HUMIDITY => $temperatureData['humidity'],
            OPI::WIND_SPEED => $apiResult['wind']['speed'],
            OPI::CITY => $apiResult['name'],
            OPI::DESCRIPTION => $apiResult['weather'][0]['description']
        ];
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws JsonException
     */
    public function execute()
    {
        $apiResult = $this->getWeatherData($this->request->getParam('city'));

        if ((int)$apiResult['cod'] === 200) {
            $weatherData = $this->extractWeatherData($apiResult);
            $openWeather = $this->openWeatherFactory->create();

            foreach ($weatherData as $key => $value) {
                $openWeather->setData($key, $value);
                $this->dataPersistor->set($key, $value);
            }

            $this->openWeatherRepository->save($openWeather);
        } else {
            $this->messageManager->addErrorMessage($apiResult['message']);
        }

        return $this->redirectFactory->create()->setRefererUrl();
    }
}
