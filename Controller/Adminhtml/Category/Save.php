<?php

namespace AHT\Portfolio\Controller\Adminhtml\Category;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'AHT_Portfolio::create_category';

    const PAGE_TITLE = 'Save Category';

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
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                $id = $data['category_id'];

                $category = $this->categoryFactory->create()->load($id);

                $data = array_filter($data, function ($value) {
                    return $value !== '';
                });

                $category->setData($data);
                $category->save();
                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/index');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $category->getId()]);
            }
        }

        return $resultRedirect->setPath('*/*/index');
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
