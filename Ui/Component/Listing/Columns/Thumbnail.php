<?php

namespace AHT\Portfolio\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * Class Thumbnail
 *
 * @api
 * @since 100.0.2
 */
class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    const NAME = 'thumbnail';

    const ALT_FIELD = 'images';

    protected $_imageCollection;
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \AHT\Portfolio\Model\ResourceModel\Image\CollectionFactory $imageCollection,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->imageHelper = $imageHelper;
        $this->_imageCollection = $imageCollection;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                $product = new \Magento\Framework\DataObject($item);
                $item['images'] = $this->_imageCollection->create()
                    ->addFieldToFilter('portfolio_id', $item['portfolio_id'])->getData();

                $imageHelper = $this->imageHelper->init($product, 'product_listing_thumbnail');
                $item[$fieldName . '_src'] = count($item['images']) > 0 ? $item['images'][0]['src'] : $imageHelper->getUrl();
                $item[$fieldName . '_alt'] = count($item['images']) > 0 ? $item['images'][0]['alt'] : $imageHelper->getLabel();
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    'portfolio/index/edit',
                    ['id' => $item['portfolio_id'], 'store' => $this->context->getRequestParam('store')]
                );
                $origImageHelper = $this->imageHelper->init($product, 'product_listing_thumbnail_preview');
                $item[$fieldName . '_orig_src'] = count($item['images']) > 0 ? $item['images'][0]['src'] : $origImageHelper->getUrl();
            }
        }
        return $dataSource;
    }

    /**
     * Get Alt
     *
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return $row[$altField] ?? null;
    }
}
