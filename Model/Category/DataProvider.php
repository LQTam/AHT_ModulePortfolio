<?php

namespace AHT\Portfolio\Model\Category;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \AHT\Portfolio\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $categoryCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $contact) {
            $this->_loadedData[$contact->getId()] = $contact->getData();
        }

        return $this->_loadedData;
    }
}
