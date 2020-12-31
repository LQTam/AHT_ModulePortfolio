<?php

namespace AHT\Portfolio\Controller\Adminhtml\Index;

class MassAction extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'AHT_Portfolio::portfolio';

    const PAGE_TITLE = 'Portfolio Delete Selected';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\Portfolio\Model\Portfolio
     */
    private $portfolio;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Portfolio\Model\ResourceModel\Portfolio $portfolio
    ) {
        $this->_pageFactory = $pageFactory;
        $this->portfolio = $portfolio;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        try {

            $tblName = $this->portfolio->getTable('aht_portfolio');
            $postRequest = $this->getRequest()->getPostValue();
            $sql = "delete from "
                . $this->portfolio->getTable('aht_portfolio')
                . ' where ' . $this->portfolio->getTable('aht_portfolio')
                . '.' . $this->portfolio->getIdFieldName() . ' in (' . implode(',', $postRequest['selected']) . ')';
            $this->portfolio->getConnection()->query($sql);

            $this->messageManager->addSuccess(__('Successfully deleted selected item.'));
            return $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/index');
        }

        return $resultRedirect;
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
