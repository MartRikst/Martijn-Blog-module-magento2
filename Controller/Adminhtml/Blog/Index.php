<?php

namespace Martijn\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Martijn\Blog\Controller\Adminhtml\Blog
 */
class Index extends Action
{
    /** pageFactory $pageFactory */
    protected $pageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
     $resultPage = $this->pageFactory->create();
     $resultPage->getConfig()->getTitle()->prepend((_('Posts')));

     // This can be set in blog_blog_index.xml

     return $resultPage;
    }
}