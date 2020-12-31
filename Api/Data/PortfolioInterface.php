<?php

namespace AHT\Portfolio\Api\Data;

interface PortfolioInterface
{
    const PORTFOLIO_ID = 'portfolio_id';
    const CATEGORY_ID = 'category_id';
    const CLIENT = 'client';
    const PROJECT = 'project';
    const SKILL = 'skill';
    const STATUS = 'status';
    const CONTENT = 'content';

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
     * Get client.
     *
     * @return string|null
     */
    public function getClient();

    /**
     * Set client.
     *
     * @param string $client
     * @return $this
     */
    public function setClient($client);

    /**
     * Get skill.
     *
     * @param string $skill
     * @return $this
     */
    public function setSkill($skill);

    /**
     * Get skill
     *
     * @return string|null
     */
    public function getSkill();

    /**
     * Get project.
     *
     * @return string|null
     */
    public function getProject();

    /**
     * Set project
     *
     * @param string $project
     * @return $this
     */
    public function setProject($project);

    /**
     * Get status.
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Set status.
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set content.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content);
}
