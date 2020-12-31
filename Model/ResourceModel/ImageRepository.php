<?php

namespace AHT\Portfolio\Model\ResourceModel;

use AHT\Portfolio\Api\Data\ImageInterface;

class ImageRepository implements \AHT\Portfolio\Api\ImageRepositoryInterface
{
    /**
     * @param \AHT\Portfolio\Model\ImageFactory
     */
    protected $_imageFactory;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Image
     */
    protected $_imageResource;

    public function __construct(
        \AHT\Portfolio\Model\ImageFactory $_imageFactory,
        \AHT\Portfolio\Model\ResourceModel\Image $_imageResource
    ) {
        $this->_imageFactory = $_imageFactory;
        $this->_imageResource = $_imageResource;
    }
    public function getById($image_id)
    {
        $imageFactory = $this->_imageFactory->create();
        try {
            $image = $imageFactory->load($image_id);
            if (is_null($image->getId())) {
                return null;
            } else {
                return $image;
            }
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function save(ImageInterface $image)
    {
        try {
            if (is_null($image->getImageId())) {
                $this->_imageResource->save($image);
                return ['success' => true, 'message' => "Success created model."];
            } else {
                $imageFactory = $this->_imageFactory->create()->load($image->getImageId());
                if (is_null($imageFactory->getImageId())) {
                    return ['success' => false, 'message' => "Unable to find the image with id: {$image->getImageId()}."];
                } else {
                    $imageFactory->setDataModel($image)->save();
                    return ['success' => true, 'message' => "Success edited model."];
                }
            }
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function getCollection()
    {
        return $this->_imageFactory->create()->getCollection()->getData();
    }

    public function deleteById($image_id)
    {
        try {
            $image = $this->getById($image_id);
            if (!empty($image)) {
                $this->_imageResource->delete($image);
                return ['success' => true, 'message' => 'Success deleted image.'];
            } else {
                throw new \Exception("Unable to delete image with id: $image_id.");
            }
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function delete(ImageInterface $image)
    {
        $imageFactory = $this->_imageFactory->create()->setData($image);
        try {
            return $this->_imageResource->delete($imageFactory);
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }
}
