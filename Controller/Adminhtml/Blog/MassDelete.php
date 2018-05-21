<?php
namespace Martijn\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Martijn\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Martijn\Blog\Model\BlogRepository;

/**
 * Class MassDelete
 */
class MassDelete extends Action
{
    /** @var Filter $filter */
    protected $filter;

    /** @var CollectionFactory $collectionFactory */
    protected $collectionFactory;

    /** @var BlogRepository $blogRepository */
    protected $blogRepository;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param BlogRepository $blogRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        BlogRepository $blogRepository
    ) {
        $this->blogRepository = $blogRepository;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;

        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection         = $this->filter->getCollection($this->collectionFactory->create());
        $collectionIds      = $collection->getAllIds();
        $collectionSize     = count($collectionIds);
        $blogRepository     = $this->blogRepository;

        foreach ($collection->getAllIds() as $blockId) {
            $id = $blogRepository->getById($blockId);
            $blogRepository->delete($id);
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 post(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
