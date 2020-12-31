<?php

namespace AHT\Portfolio\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    public function isEnabled($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'portfolio/general/enabled',
            $scope
        );
    }

    public function getPageTitle($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'portfolio/general/page_title',
            $scope
        );
    }

    public function getMetaDescription($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'portfolio/seo_metadata/description',
            $scope
        );
    }

    public function getMetaKeywords($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'portfolio/seo_metadata/keywords',
            $scope
        );
    }
}
