<?php

namespace AHT\Portfolio\Model;

class Image extends \Magento\Framework\Model\AbstractModel implements
    \Magento\Framework\DataObject\IdentityInterface,
    \AHT\Portfolio\Api\Data\ImageInterface
{
    const CACHE_TAG = 'aht_portfolio_image';

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
    protected $_eventPrefix = 'image';

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
        $this->_init('AHT\Portfolio\Model\ResourceModel\Image');
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
    public function getImageId()
    {
        return $this->getData(self::IMAGE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setImageId($image_id)
    {
        $this->setData(self::IMAGE_ID, $image_id);
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
    public function getPortfolioId()
    {
        return $this->getData(self::PORTFOLIO_ID);
    }



    /**
     * @inheritDoc
     */
    public function getThumbnail()
    {
        return $this->getData(self::THUMBNAIL);
    }

    /**
     * @inheritDoc
     */
    public function setThumbnail($thumbnail)
    {
        $this->setData(self::THUMBNAIL, $thumbnail);
    }

    /**
     * @inheritDoc
     */
    public function setAlt($alt)
    {
        $this->setData(self::ALT, $alt);
    }

    /**
     * @inheritDoc
     */
    public function getAlt()
    {
        return $this->getData(self::ALT);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->setData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function getSrc()
    {
        return $this->getData(self::SRC);
    }

    /**
     * @inheritDoc
     */
    public function setSrc($src)
    {
        $this->setData(self::SRC);
    }

    /**
     * @inheritDoc
     */
    public function getWidth()
    {
        return $this->getData(self::WIDTH);
    }

    /**
     * @inheritDoc
     */
    public function setWidth($width)
    {
        $this->setData(self::WIDTH, $width);
    }

    /**
     * @inheritDoc
     */
    public function getHeight()
    {
        return $this->getData(self::HEIGHT);
    }

    /**
     * @inheritDoc
     */
    public function setHeight($height)
    {
        $this->setData(self::HEIGHT, $height);
    }

    public function setDataModel(\AHT\Portfolio\Api\Data\ImageInterface $image)
    {
        $this->setPortfolioId($image->getPortfolioId());
        $this->setThumbnail($image->getThumbnail());
        $this->setName($image->getName());
        $this->setSrc($image->getSrc());
        $this->setAlt($image->getAlt());
        $this->setWidth($image->getWidth());
        $this->setHeight($image->getHeight());
        return $this;
    }
}
