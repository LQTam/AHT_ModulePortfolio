<?php

namespace AHT\Portfolio\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'AHT_Portfolio::create_portfolio';

    const PAGE_TITLE = 'Save Portfolio';

    protected $portfolioFactory;
    protected $_imageUploader;
    protected $_imageFactory;
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
        \AHT\Portfolio\Model\PortfolioFactory $portfolioFactory,
        \AHT\Portfolio\Model\ImageUploader $imageUploader,
        \AHT\Portfolio\Model\ImageFactory $imageFactory
    ) {
        $this->_imageUploader = $imageUploader;
        $this->_imageFactory = $imageFactory;
        $this->portfolioFactory = $portfolioFactory;
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
                $id = $data['portfolio_id'];
                $data = array_filter($data, function ($value) {
                    return $value !== '';
                });

                $portfolio = $this->portfolioFactory->create();
                $imageFactory = $this->_imageFactory->create();

                if (isset($data['images']) && count($data['images']) > 0) {
                    $imageName = $data['images'][0]['name'];
                    if (isset($data['images'][0]['tmp_name'])) {
                        $this->_imageUploader->moveFileFromTmp($imageName);
                    }
                    $name = [];
                    if (isset($data['imageRoles']) && count($data['imageRoles']) > 0) {
                        foreach ($data['imageRoles'] as $role) {
                            array_push($name, $role . '-' . $imageName);
                        }
                    }
                }
                if (empty($id)) {
                    $portfolio->setData($data);
                    $portfolio->save();

                    if (isset($data['images'][0]['url'])) {
                        $nameFormat = str_replace('tmp', 'images', $data['images'][0]['url']);
                        $dataImage = [
                            'portfolio_id' => $portfolio->getId(),
                            'thumbnail' => explode(".", $imageName)[0],
                            'name' => implode(',', $name),
                            'src' => $nameFormat,
                            'alt' => $imageName,
                        ];
                    }
                    if (isset($data['images']) && count($data['images']) > 0) {

                        $imageFactory->setData($dataImage);
                        $imageFactory->save();
                    }
                    $this->messageManager->addSuccess(__('Successfully saved the item.'));
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                    return $resultRedirect->setPath('*/*/index');
                } else {

                    $portfolio = $portfolio->load($id);
                    $portfolio->setData($data);
                    $portfolio->save();

                    if (isset($data['images'][0]['url'])) {
                        $nameFormat = str_replace('tmp', 'images', $data['images'][0]['url']);
                        $dataImage = [
                            'portfolio_id' => $portfolio->getId(),
                            'thumbnail' => explode(".", $imageName)[0],
                            'name' => implode(',', $name),
                            'src' => $nameFormat,
                            'alt' => $imageName,
                        ];
                    }
                    if (isset($data['images']) &&  count($data['images']) > 0) {
                        if (isset($data['images'][0]['image_id'])) {
                            $imageFactory = $imageFactory->load($data['images'][0]['image_id']);
                            $dataImage['image_id'] = $imageFactory->getId();
                            $dataImage['portfolio_id'] = $portfolio->getId();
                        }
                        $imageFactory->setData($dataImage);
                        $imageFactory->save();
                    }
                    $this->messageManager->addSuccess(__('Successfully edited the item.'));
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                    return $resultRedirect->setPath('*/*/index');
                }
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/index');
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
