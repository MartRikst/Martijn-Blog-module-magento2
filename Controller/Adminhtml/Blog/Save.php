<?php
namespace Martijn\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Martijn\Blog\Model\Blog;
use Martijn\Blog\Model\BlogFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Martijn\Blog\Model\BlogRepository;

/**
 * Class Save
 * @package Martijn\Blog\Controller\Adminhtml\Blog
 */
class Save extends Action
{
    /** @var $blogRepository BlogRepository */
    protected $blogRepository;

    /** @var BlogFactory $blogFactory */
    protected $blogFactory;

    /** @var DateTime $dateTime */
    protected $dateTime;

    /**
     * Save constructor.
     * @param Context $context
     * @param BlogFactory $blogFactory
     * @param DateTime $dateTime
     * @param BlogRepository $blogRepository
     */
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        DateTime $dateTime,
        BlogRepository $blogRepository
    ) {
        $this->blogRepository = $blogRepository;
        $this->blogFactory = $blogFactory;
        $this->dateTime = $dateTime;

        parent::__construct($context);
    }

    /**
     * @return $this|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $postData = $this->getRequest()->getPostValue();
        $postId = $postData['id'];

        // If this is a new blog and not an existing blog
        if (!$postId) {
            /** @var Blog $blogModel */
            $blogModel = $this->blogFactory->create();

            $postData['id'] = null;
        } else {
            /** @var Blog $blogModel */
            $blogModel = $this->blogRepository->getById($postId);

            if (!$blogModel) {
                $this->messageManager->addErrorMessage(__('Could not load blog with ID: %s'), $postId);
                return $resultRedirect->setPath('*/*/');
            }
        }

        $blogModel->setData($postData);

        try {
            if ($blogModel) {
                $this->blogRepository->save($blogModel);
                $this->messageManager->addSuccessMessage(__('Blog post has successfully been saved'));
            } else {
                $this->messageManager->addErrorMessage(__('This blog post cannot be saved, missing data.'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, $e->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}