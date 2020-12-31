<?php

namespace AHT\Portfolio\Api;

interface ImageRepositoryInterface
{
    /**
     * Get image by given image id.
     * @param int $image_id
     * @return \AHT\Portfolio\Api\Data\ImageInterface
     */
    public function getById($image_id);

    /**
     * Save image 
     * @return bool
     */
    public function upload();


    /**
     * Save the image model.
     *
     * @param \AHT\Portfolio\Api\Data\ImageInterface $image
     * @return \AHT\Portfolio\Api\Data\ImageInterface
     */
    public function save(\AHT\Portfolio\Api\Data\ImageInterface $image);

    /**
     * Get collection of image.
     *
     * @return \AHT\Portfolio\Api\Data\ImageInterface[]
     */
    public function getCollection();

    /**
     * Delete the model by given image id.
     *
     * @param int $image_id
     * @return bool
     */
    public function deleteById($image_id);

    /**
     * Delete the model image.
     *
     * @param \AHT\Portfolio\Api\Data\ImageInterface $image
     * @return bool
     */
    public function delete(\AHT\Portfolio\Api\Data\ImageInterface $image);
}
