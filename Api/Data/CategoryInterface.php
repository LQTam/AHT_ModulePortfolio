<?php

namespace AHT\Portfolio\Api\Data;

interface CategoryInterface
{
    const CATEGORY_ID = 'category_id';
    const NAME = 'name';

    /**
     * Get category id.
     *
     * @return int|null
     */
    public function getCategoryId();

    /**
     * Set category id.
     *
     * @param int $category_id
     * @return $this
     */
    public function setCategoryId($category_id);

    /**
     * Get category name.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set category name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);
}
