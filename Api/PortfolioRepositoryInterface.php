<?php

namespace AHT\Portfolio\Api;

interface PortfolioRepositoryInterface
{
    /**
     * Get portfolio by given portfolio id.
     * @param int $portfolio_id
     * @return \AHT\Portfolio\Api\Data\PortfolioInterface
     */
    public function getById($portfolio_id);

    /**
     * Save the portfolio model.
     *
     * @param \AHT\Portfolio\Api\Data\PortfolioInterface $portfolio
     * @return \AHT\Portfolio\Api\Data\PortfolioInterface
     */
    public function save(\AHT\Portfolio\Api\Data\PortfolioInterface $portfolio);

    /**
     * Get collection of portfolio.
     *
     * @return \AHT\Portfolio\Api\Data\PortfolioInterface[]
     */
    public function getCollection();

    /**
     * Delete the model by given portfolio id.
     *
     * @param int $portfolio_id
     * @return bool
     */
    public function deleteById($portfolio_id);

    /**
     * Delete the model portfolio.
     *
     * @param \AHT\Portfolio\Api\Data\PortfolioInterface $portfolio
     * @return bool
     */
    public function delete(\AHT\Portfolio\Api\Data\PortfolioInterface $portfolio);
}
