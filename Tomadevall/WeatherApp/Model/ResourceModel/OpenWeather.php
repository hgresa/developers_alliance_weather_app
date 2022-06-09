<?php

namespace Tomadevall\WeatherApp\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Psr\Log\LoggerInterface;
use Magento\Framework\Model\ResourceModel\Db\Context;

class OpenWeather extends AbstractDb
{
    protected LoggerInterface $logger;

    public function __construct(
        Context         $context,
        LoggerInterface $logger,
                        $connectionName = null
    )
    {
        parent::__construct($context, $connectionName);
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('weather_historical_data', 'id');
    }

    /**
     * @return array|null
     */
    public function getFields(): ?array
    {
        try {
            return array_keys($this->getConnection()->describeTable($this->getMainTable()));
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}
