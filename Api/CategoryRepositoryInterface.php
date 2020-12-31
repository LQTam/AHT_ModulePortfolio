<?php

namespace AHT\Portfolio\Api;

interface CategoryRepositoryInterface
{
    /**
     * Get category by given category id.
     * @param int $category_id
     * @return \AHT\Portfolio\Api\Data\CategoryInterface
     */
    public function getById($category_id);

    /**
     * Save the category model.
     *
     * @param \AHT\Portfolio\Api\Data\CategoryInterface $category
     * @return \AHT\Portfolio\Api\Data\CategoryInterface
     */
    public function save(\AHT\Portfolio\Api\Data\CategoryInterface $category);

    /**
     * Get collection of category.
     *
     * @return \AHT\Portfolio\Api\Data\CategoryInterface[]
     */
    public function getCollection();

    /**
     * Delete the model by given category id.
     *
     * @param int $category_id
     * @return bool
     */
    public function deleteById($category_id);

    /**
     * Delete the model category.
     *
     * @param \AHT\Portfolio\Api\Data\CategoryInterface $category
     * @return bool
     */
    public function delete(\AHT\Portfolio\Api\Data\CategoryInterface $category);
}
