<?php

namespace Tomadevall\WeatherApp\Controller\Data;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Tomadevall\WeatherApp\Model\ResourceModel\OpenWeather\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Psr\Log\LoggerInterface;
use Spipu\Html2Pdf\Html2Pdf;
use Magento\Framework\View\LayoutFactory;
use Tomadevall\WeatherApp\Block\OpenWeather;

class GeneratePDF implements HttpGetActionInterface
{
    protected CollectionFactory $openWeatherCollectionFactory;

    protected ResultFactory $resultFactory;

    protected LoggerInterface $logger;

    protected LayoutFactory $layoutFactory;

    /**
     * @param CollectionFactory $openWeatherCollectionFactory
     * @param ResultFactory $resultFactory
     * @param LoggerInterface $logger
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        CollectionFactory $openWeatherCollectionFactory,
        ResultFactory     $resultFactory,
        LoggerInterface   $logger,
        LayoutFactory     $layoutFactory
    )
    {
        $this->openWeatherCollectionFactory = $openWeatherCollectionFactory;
        $this->resultFactory = $resultFactory;
        $this->logger = $logger;
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * @return void
     */
    private function generateHistoricalDataPdf(): void
    {
        try {
            $historicalDataHtml = $this->layoutFactory->create()
                ->createBlock(OpenWeather::class)
                ->setTemplate('Tomadevall_WeatherApp::weather_pdf_table.phtml')
                ->toHtml();

            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->writeHTML($historicalDataHtml);
            $html2pdf->output('test1.pdf', 'D');
        } catch (Html2PdfException $exception) {
            $html2pdf->clean();
            $this->logger->error($exception->getMessage());
        }
    }

    public function execute()
    {
        $this->generateHistoricalDataPdf();

        return $this->resultFactory->create(ResultFactory::TYPE_RAW);
    }
}
