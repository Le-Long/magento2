<?php

namespace Dabilo\MiniWindow\Block;


use Dabilo\MiniWindow\Model\News;
use Dabilo\MiniWindow\Model\NewsFactory;
use Magento\Framework\View\Element\Template;

class NewsBlock extends Template
{
    /**
     * @var NewsFactory
     */
    private NewsFactory $NewsFactory;

    /**
     * NewsBlock constructor.
     * @param Template\Context $context
     * @param NewsFactory $NewsFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        NewsFactory $NewsFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->NewsFactory = $NewsFactory;
    }

    /**
     * @return object
     */
    public function getNewsInformation(): object
    {
        return $this->NewsFactory->create()->getNewsResponse();
    }
}
