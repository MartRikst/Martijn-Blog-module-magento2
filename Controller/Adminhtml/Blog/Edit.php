<?php

namespace Martijn\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Edit
 * @package Martijn\Blog\Controller\Adminthml\Blog
 */
class Edit extends Action
{
    /** @var ResultFactory $resultFactory */
    protected $resultFactory;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        Action\Context $context,
        ResultFactory $resultFactory
    ) {
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(resultFactory::TYPE_PAGE);
        return $resultPage;
    }
}