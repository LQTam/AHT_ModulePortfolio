<?php

namespace AHT\Portfolio\Model\Image\Source;

class Roles implements \Magento\Framework\Data\OptionSourceInterface
{
    const ROLES = ['thumbnail', 'small', 'base', 'swatch'];
    protected $_imageCollectionFactory;
    public function __construct(
        \AHT\Portfolio\Model\ResourceModel\Image\CollectionFactory $imageCollectionFactory
    ) {
        $this->_imageCollectionFactory = $imageCollectionFactory;
    }
    public function toOptionArray()
    {
        return [
            [
                'value' => 'thumbnail',
                'label' => 'Thumbnail',
            ],
            [
                'value' => 'small',
                'label' => 'Small',
            ],
            [
                'value' => 'base',
                'label' => 'Base',
            ],
            [
                'value' => 'swatch',
                'label' => 'Swatch',
            ],
        ];
    }
}
