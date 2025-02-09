<?php

namespace Dabilo\MiniWindow\Block;


use Dabilo\MiniWindow\Model\Weather;
use Dabilo\MiniWindow\Model\WeatherFactory;
use Magento\Framework\View\Element\Template;

class WeatherBlock extends Template
{
    /**
     * @var WeatherFactory
     */
    private WeatherFactory $weatherFactory;

    /**
     * WeatherBlock constructor.
     * @param Template\Context $context
     * @param WeatherFactory $weatherFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        WeatherFactory $weatherFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->weatherFactory = $weatherFactory;
    }

    /**
     * @return object
     */
    public function getWeatherInformation(): object
    {
        return $this->weatherFactory->create()->getWeatherResponse();
    }
}
