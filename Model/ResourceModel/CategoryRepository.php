<?php

namespace AHT\Portfolio\Model\ResourceModel;

use AHT\Portfolio\Api\Data\CategoryInterface;

class CategoryRepository implements \AHT\Portfolio\Api\CategoryRepositoryInterface
{
    /**
     * @param \AHT\Portfolio\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Category
     */
    protected $_categoryResource;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;

    public function __construct(
        \AHT\Portfolio\Model\CategoryFactory $_categoryFactory,
        \AHT\Portfolio\Model\ResourceModel\Category $_categoryResource,
        \AHT\Portfolio\Model\ResourceModel\Category\CollectionFactory $_categoryCollectionFactory
    ) {
        $this->_categoryFactory = $_categoryFactory;
        $this->_categoryResource = $_categoryResource;
        $this->_categoryCollectionFactory = $_categoryCollectionFactory;
    }
    public function getById($category_id)
    {
        $categoryFactory = $this->_categoryFactory->create();
        try {
            $category = $categoryFactory->load($category_id);
            if (is_null($category->getId())) {
                return null;
            } else {
                return $category;
            }
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function save(CategoryInterface $category)
    {
        return "AAA";

        try {
            if (is_null($category->getCategoryId())) {
                $this->_categoryResource->save($category);
                return ['success' => true, 'message' => "Success created model."];
            } else {
                $categoryFactory = $this->_categoryFactory->create()->load($category->getCategoryId());
                if (is_null($categoryFactory->getCategoryId())) {
                    return ['success' => false, 'message' => "Unable to find the category with id: {$category->getCategoryId()}."];
                } else {
                    $categoryFactory->setData($category)->save();
                    return ['success' => true, 'message' => "Success edited model."];
                }
            }
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function getCollection()
    {
        return $this->_categoryCollectionFactory->create()->getData();
    }

    public function deleteById($category_id)
    {
        try {
            $category = $this->getById($category_id);
            if (!empty($category)) {
                $this->_categoryResource->delete($category);
                return ['success' => true, 'message' => 'Success deleted category.'];
            } else throw new \Exception("Unable to delete category with id: $category_id.");
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function delete(CategoryInterface $category)
    {
        $categoryFactory = $this->_categoryFactory->create()->setData($category);
        try {
            return $this->_categoryResource->delete($categoryFactory);
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }
}
