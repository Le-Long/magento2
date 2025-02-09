<?php

namespace Dabilo\MiniWindow\Block;


use Dabilo\MiniWindow\Model\Currency;
use Dabilo\MiniWindow\Model\CurrencyFactory;
use Magento\Framework\View\Element\Template;

class CurrencyBlock extends Template
{
    /**
     * @var CurrencyFactory
     */
    private CurrencyFactory $CurrencyFactory;

    /**
     * CurrencyBlock constructor.
     * @param Template\Context $context
     * @param CurrencyFactory $CurrencyFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CurrencyFactory $CurrencyFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->CurrencyFactory = $CurrencyFactory;
    }

    /**
     * @return object
     */
    public function getCurrencyInformation(): object
    {
        return $this->CurrencyFactory->create()->getCurrencyResponse();
    }
}
