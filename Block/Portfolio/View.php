<?php

namespace AHT\Portfolio\Block\Portfolio;

class View extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \AHT\Portfolio\Model\PortfolioFactory
     */
    protected $_portfolioFactory;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Image\CollectionFactory
     */
    protected $_imagCollection;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollection;

    /**
     * @param \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\Portfolio\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Portfolio\Model\PortfolioFactory $_portfolioFactory,
        \AHT\Portfolio\Model\ResourceModel\Image\CollectionFactory $_imagCollection,
        \AHT\Portfolio\Model\ResourceModel\Category\CollectionFactory $_categoryCollection,
        \Magento\Framework\View\Result\PageFactory $_pageFactory,
        \AHT\Portfolio\Model\CategoryFactory $_categoryFactory,
        array $data = []
    ) {
        $this->_portfolioFactory = $_portfolioFactory;
        $this->_imagCollection = $_imagCollection;
        $this->_categoryCollection = $_categoryCollection;
        $this->_pageFactory = $_pageFactory;
        $this->_categoryFactory = $_categoryFactory;
        parent::__construct($context, $data);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }

    public function getPortfolio()
    {
        $id = $this->getRequest()->getParam('id');
        $portfolio = $this->_portfolioFactory->create()->load($id)->getData();
        $portfolio['image'] = $this->_imagCollection->create()->addFieldToFilter('portfolio_id', $id)
            ->addFieldToFilter('name', ['like' => '%base%'])->getData();
        $portfolio['category'] = $this->_categoryFactory->create()->load($portfolio['category_id'])->getData('name');
        if (count($portfolio['image']) > 0) {
            $portfolio['image'] = $portfolio['image'][0];
        }
        return $portfolio;
    }
}
