<?php

namespace AHT\Portfolio\Api\Data;

interface ImageInterface
{
    const IMAGE_ID = 'image_id';
    const PORTFOLIO_ID = 'portfolio_id';
    const THUMBNAIL = 'thumbnail';
    const NAME = 'name';
    const ALT = 'alt';
    const SRC = 'src';
    const WIDTH = 'width';
    const HEIGHT = 'height';

    /**
     * Get portfolio id.
     *
     * @return int|null
     */
    public function getPortfolioId();

    /**
     * Set portfolio id.
     *
     * @param int $portfolio_id
     * @return $this
     */
    public function setPortfolioId($portfolio_id);

    /**
     * Get image id.
     *
     * @return int|null
     */
    public function getImageId();

    /**
     * Set image id.
     *
     * @param int $image_id
     * @return $this
     */
    public function setImageId($image_id);

    /**
     * Get thumbnail.
     *
     * @return string|null
     */
    public function getThumbnail();

    /**
     * Set thumbnail.
     *
     * @param string $thumbnail
     * @return $this
     */
    public function setThumbnail($thumbnail);

    /**
     * Get alt.
     *
     * @param string $alt
     * @return $this
     */
    public function setAlt($alt);

    /**
     * Get alt
     *
     * @return string|null
     */
    public function getAlt();

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get src.
     *
     * @return string|null
     */
    public function getSrc();

    /**
     * Set src.
     *
     * @param string $src
     * @return $this
     */
    public function setSrc($src);

    /**
     * Get width.
     *
     * @return int|null
     */
    public function getWidth();

    /**
     * Set width.
     *
     * @param int $width
     * @return $this
     */
    public function setWidth($width);

    /**
     * Get height.
     *
     * @return int|null
     */
    public function getHeight();

    /**
     * Set height.
     *
     * @param int $height
     * @return $this
     */
    public function setHeight($height);
}
