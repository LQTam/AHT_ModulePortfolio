<?php

namespace AHT\Portfolio\Model\ResourceModel\Image;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'image_id';
    protected $_eventPrefix = 'aht_portfolio_image_collection';
    protected $_eventObject = 'image_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Portfolio\Model\Image', 'AHT\Portfolio\Model\ResourceModel\Image');
    }
}
