<?php

namespace AHT\Portfolio\Model\Category\Source;

class Categories implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $categories;

    public function __construct(
        \AHT\Portfolio\Model\ResourceModel\Category\CollectionFactory $categories
    ) {
        $this->categories = $categories;
    }
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->categories->create()->getItems() as $category) {
            array_push(
                $options,
                [
                    'value' => $category->getData('category_id'),
                    'label' => $category->getData('name')
                ]
            );
        }
        return $options;
    }
}
