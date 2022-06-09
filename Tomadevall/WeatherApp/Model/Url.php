<?php

namespace Tomadevall\WeatherApp\Model;

use Magento\Framework\UrlInterface;

class Url
{
    protected UrlInterface $urlBuilder;

    /**
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        UrlInterface $urlBuilder
    )
    {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getWeatherPostUrl(): string
    {
        return $this->urlBuilder->getUrl('weather/data/getpost');
    }
}