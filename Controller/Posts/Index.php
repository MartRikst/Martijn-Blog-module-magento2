<?php

namespace Martijn\Blog\Controller\Posts;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Martijn\Blog\Model\ResourceModel\Blog\CollectionFactory;

/**
 * Class Index
 * @package Martijn\Blog\Controller\Blog
 */
class Index extends Action
{
    /** @var PageFactory $pageFactory */
    protected $pageFactory;

    /** @var CollectionFactory $blogCollectionFactory */
    protected $blogCollectionFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param CollectionFactory $blogCollectionFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $blogCollectionFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->blogCollectionFactory = $blogCollectionFactory;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }
}