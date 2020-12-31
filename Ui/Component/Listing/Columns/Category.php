<?php

namespace AHT\Portfolio\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Category extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $urlBuilder;

    /**
     * @param  \AHT\Portfolio\Model\ResourceModel\Category\Collection $_categoryCollection
     */

    private $_categoryCollection;
    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Category\Collection
     */

    public function __construct(ContextInterface $context, \AHT\Portfolio\Model\ResourceModel\Category\CollectionFactory $_categoryCollection, UiComponentFactory $uiComponentFactory, UrlInterface $urlBuilder, array $components = [], array $data = [])
    {
        $this->urlBuilder = $urlBuilder;
        $this->_categoryCollection = $_categoryCollection;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $categoryCollection = $this->_categoryCollection->create()
                    ->addFieldToFilter('category_id', $item['category_id'])
                    ->addFieldToSelect(['name']);
                // echo "<pre>";
                // print_r($categoryCollection->getData());
                // die;
                $item['category_id'] = $categoryCollection->getData()[0]['name'];
            }
        }
        return $dataSource;
    }
}
