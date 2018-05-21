<?php
namespace Martijn\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Martijn\Blog\Model\BlogRepository;


/**
 * Class Delete
 * @package Martijn\Blog\Controller\Adminhtml\Blog
 */
class Delete extends Action
{
    /** @var $blogRepository blogRepository */
    protected $blogRepository;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param BlogRepository $blogRepository
     */
    public function __construct(
        Action\Context $context,
        blogRepository $blogRepository
    ) {
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
    }


    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var RedirectFactory $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                //delete
                $blogId = $this->blogRepository->getById($id);
                $this->blogRepository->delete($blogId);
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the post succesfully.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');

            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['block_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('Post cannot be deleted.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
