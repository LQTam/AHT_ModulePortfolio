<?php

namespace AHT\Portfolio\Model\Portfolio;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_imageCollectionFactory;
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \AHT\Portfolio\Model\ResourceModel\Portfolio\Grid\CollectionFactory $portfolioCollectionFactory,
        \AHT\Portfolio\Model\ResourceModel\Image\CollectionFactory $imageCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $portfolioCollectionFactory->create();
        $this->_imageCollectionFactory = $imageCollectionFactory->create();

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            $items = $this->collection->getItems();
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        $ext = [];
        foreach ($items as $portfolio) {
            $itemData = $portfolio->getData();
            $images = $this->_imageCollectionFactory->addFieldToFilter('portfolio_id', $portfolio->getId());
            if (count($images->getData()) > 0) {

                foreach (explode(',', $images->getData()[0]['name']) as $value) {
                    array_push($ext, explode('-', $value)[0]);
                }
                $itemData['imageRoles'] = $ext;
                $imageName =
                    $images->getData()[0]['thumbnail']; // Your database field 
                unset($itemData['images']);
                $imageUrl =
                    $images->getData()[0]['src'];
                $itemData['images'] = $images->getData();
            }
            $this->_loadedData[$portfolio->getId()] = $itemData;
        }
        return $this->_loadedData;
    }
}
