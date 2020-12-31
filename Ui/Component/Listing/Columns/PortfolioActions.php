<?php

namespace AHT\Portfolio\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class PortfolioActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $urlBuilder;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, UrlInterface $urlBuilder, array $components = [], array $data = [])
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl('portfolio/index/edit', ['id' => $item['portfolio_id']]),
                    'label' => __('Edit'),
                    'hidden' => false,
                    '__disableTmpl' => true
                ];
                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl('portfolio/index/delete', ['id' => $item['portfolio_id']]),
                    'label' => __('Delete'),
                    'hidden' => false
                ];
            }
        }

        return $dataSource;
    }
}
