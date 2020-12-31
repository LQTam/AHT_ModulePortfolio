<?php

namespace AHT\Portfolio\Model\ResourceModel;

use AHT\Portfolio\Api\Data\PortfolioInterface;

class PortfolioRepository implements \AHT\Portfolio\Api\PortfolioRepositoryInterface
{
    /**
     * @param \AHT\Portfolio\Model\PortfolioFactory
     */
    protected $_portfolioFactory;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Portfolio
     */
    protected $_portfolioResource;

    /**
     * @param \AHT\Portfolio\Model\ResourceModel\Portfolio\CollectionFactory
     */
    protected $_portfolioCollectionFactory;

    public function __construct(
        \AHT\Portfolio\Model\PortfolioFactory $_portfolioFactory,
        \AHT\Portfolio\Model\ResourceModel\Portfolio $_portfolioResource,
        \AHT\Portfolio\Model\ResourceModel\Portfolio\CollectionFactory $_portfolioCollectionFactory
    ) {
        $this->_portfolioFactory = $_portfolioFactory;
        $this->_portfolioResource = $_portfolioResource;
        $this->_portfolioCollectionFactory = $_portfolioCollectionFactory;
    }
    public function getById($portfolio_id)
    {
        $portfolioFactory = $this->_portfolioFactory->create();
        try {
            $portfolio = $portfolioFactory->load($portfolio_id);
            if (is_null($portfolio->getId())) {
                return null;
            } else {
                return $portfolio;
            }
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    // public function load(PortfolioInterface $portfolio)
    // {
    // }

    public function save(PortfolioInterface $portfolio)
    {
        try {
            if (is_null($portfolio->getPortfolioId())) {
                $this->_portfolioResource->save($portfolio);
                return ['success' => true, 'message' => "Success created model."];
            } else {
                $portfolioFactory = $this->_portfolioFactory->create()->load($portfolio->getPortfolioId());
                if (is_null($portfolioFactory->getPortfolioId())) {
                    return ['success' => false, 'message' => "Unable to find the portfolio with id: {$portfolio->getPortfolioId()}."];
                } else {
                    $portfolioFactory->setDataModel($portfolio)->save();
                    return ['success' => true, 'message' => "Success edited model."];
                }
            }
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function getCollection()
    {
        return $this->_portfolioCollectionFactory->create()->getData();
    }

    public function deleteById($portfolio_id)
    {
        try {
            $portfolio = $this->getById($portfolio_id);
            if (!empty($portfolio)) {
                $this->_portfolioResource->delete($portfolio);
                return ['success' => true, 'message' => 'Success deleted portfolio.'];
            } else throw new \Exception("Unable to delete portfolio with id: $portfolio_id.");
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    public function delete(PortfolioInterface $portfolio)
    {
        $portfolioFactory = $this->_portfolioFactory->create()->setData($portfolio);
        try {
            return $this->_portfolioResource->delete($portfolioFactory);
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }
}
