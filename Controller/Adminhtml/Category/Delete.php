<?php

namespace AHT\Portfolio\Controller\Adminhtml\Category;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'AHT_Portfolio::delete_category';

    const PAGE_TITLE = 'Delete Category';

    protected $categoryFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Portfolio\Model\CategoryFactory $categoryFactory
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->_pageFactory = $pageFactory;
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
            $id = $this->getRequest()->getParam('id');

            $contact = $this->categoryFactory->create()->setId($id);
            $contact->delete();
            $this->messageManager->addSuccess(__('Successfully deleted the item.'));
            return $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
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
