<?php

namespace AHT\Portfolio\Controller\Adminhtml\Index;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'AHT_Portfolio::delete_portfolio';

    const PAGE_TITLE = 'Delete Portfolio';

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
        \AHT\Portfolio\Model\PortfolioFactory $portfolio
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

            $this->portfolio->create()->setId($this->getRequest()->getParam('id'))->delete();
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
