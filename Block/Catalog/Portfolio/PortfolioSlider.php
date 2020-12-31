<?php

namespace AHT\Portfolio\Block\Catalog\Portfolio;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PortfolioSlider extends Template implements BlockInterface
{
    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Portfolio\Collection
     */
    protected $_portfolioCollection;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Image\Collection
     */
    protected $_imageCollection;

    /**
     * @param \AHT\Portfolio\Model\Category
     */
    protected $_categoryFactory;

    /**
     * @param \AHT\Portfolio\Helper\Data
     */
    private $_helperDataConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Portfolio\Model\ResourceModel\Portfolio\CollectionFactory $_portfolioCollection,
        \AHT\Portfolio\Model\ResourceModel\Image\CollectionFactory $_imageCollection,
        \AHT\Portfolio\Model\CategoryFactory $_categoryFactory,
        \AHT\Portfolio\Helper\Data $_helperDataConfig,
        array $data = []
    ) {
        $this->_portfolioCollection = $_portfolioCollection;
        $this->_imageCollection = $_imageCollection;
        $this->_categoryFactory = $_categoryFactory;
        $this->_helperDataConfig = $_helperDataConfig;
        parent::__construct($context, $data);
    }
    public function getPortfolioCollection()
    {
        $perPage = $this->getData('portfolio_per_page') ?: 5;
        $collection = $this->_portfolioCollection->create()
            ->setPageSize($perPage)->getData();
        foreach ($collection as $key => $portfolio) {
            $collection[$key]['images'] = $this->_imageCollection->create()
                ->addFieldToFilter('portfolio_id', $portfolio['portfolio_id'])
                ->addFieldToFilter('name', ['like' => '%base%'])->getData();
            $collection[$key]['category'] = $this->_categoryFactory->create()->load($portfolio['category_id'])->getData('name');
        }

        return $collection;
    }

    public function isEnabled()
    {
        return $this->_helperDataConfig->isEnabled();
    }
}
