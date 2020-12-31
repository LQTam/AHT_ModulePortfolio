<?php

namespace AHT\Portfolio\Model;

use AHT\Portfolio\Api\Data\PortfolioInterface;

class Portfolio extends \Magento\Framework\Model\AbstractModel implements
    \Magento\Framework\DataObject\IdentityInterface,
    \AHT\Portfolio\Api\Data\PortfolioInterface
{
    const CACHE_TAG = 'aht_portfolio_portfolio';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'portfolio';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Portfolio\Model\ResourceModel\Portfolio');
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @inheritDoc
     */
    public function getPortfolioId()
    {
        return $this->getData(self::PORTFOLIO_ID);
    }

    /**
     * @inheritDoc
     */
    public function setPortfolioId($portfolio_id)
    {
        $this->setData(self::PORTFOLIO_ID, $portfolio_id);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryId($category_id)
    {
        $this->setData(self::CATEGORY_ID, $category_id);
    }

    /**
     * @inheritDoc
     */
    public function getClient()
    {
        return $this->getData(self::CLIENT);
    }

    /**
     * @inheritDoc
     */
    public function setClient($client)
    {
        $this->setData(self::CLIENT, $client);
    }

    /**
     * @inheritDoc
     */
    public function setSkill($skill)
    {
        $this->setData(self::SKILL, $skill);
    }

    /**
     * @inheritDoc
     */
    public function getSkill()
    {
        return $this->getData(self::SKILL);
    }

    /**
     * @inheritDoc
     */
    public function getProject()
    {
        return $this->getData(self::PROJECT);
    }

    /**
     * @inheritDoc
     */
    public function setProject($project)
    {
        $this->setData(self::PROJECT, $project);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        $this->setData(self::CONTENT, $content);
    }

    public function setDataModel(\AHT\Portfolio\Api\Data\PortfolioInterface $portfolio)
    {
        $this->setClient($portfolio->getClient());
        $this->setProject($portfolio->getProject());
        $this->setSkill($portfolio->getSkill());
        $this->setContent($portfolio->getContent());
        $this->setStatus($portfolio->getStatus());
        return $this;
    }
}
