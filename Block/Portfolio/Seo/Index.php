<?php

namespace AHT\Portfolio\Block\Portfolio\Seo;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \AHT\Portfolio\Helper\Data
     */
    private $_helperDataConfig;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Portfolio\Helper\Data $_helperDataConfig,
        array $data = []
    ) {
        $this->_helperDataConfig = $_helperDataConfig;
        parent::__construct($context, $data);
    }

    public function getPageTitle()
    {
        return $this->_helperDataConfig->getPageTitle();
    }

    public function getMetaDescription()
    {
        return $this->_helperDataConfig->getMetaDescription();
    }

    public function getMetaKeywords()
    {
        return $this->_helperDataConfig->getMetaKeywords();
    }
}
