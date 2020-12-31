<?php

namespace AHT\Portfolio\Model\ResourceModel\Portfolio\Grid;

use AHT\Portfolio\Model\Portfolio;
use AHT\Portfolio\Model\ResourceModel\Portfolio as ResourceModelPortfolio;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

use Magento\Customer\Ui\Component\DataProvider\Document;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    /**
     * @inheritdoc
     */
    protected $document = Document::class;

    /**
     * @inheritdoc
     */
    protected $_map = ['fields' => ['portfolio_id' => 'main_table.portfolio_id']];

    /**
     * Initialize dependencies.
     *
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param string $mainTable
     * @param string $resourceModel
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'aht_portfolio333',
        $resourceModel = \AHT\Portfolio\Model\ResourceModel\Portfolio::class
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }
}
