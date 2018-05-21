<?php
namespace Martijn\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Martijn\Blog\Model\BlogRepository;
use Martijn\Blog\Api\Data\BlogInterface;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\App\Request\Http as Request;

/**
 * Class BlogPost
 * @package Martijn\Blog\Block
 */
class BlogPost extends Template
{
    /** @var BlogRepository $blogRepository */
    protected $blogRepository;

    /** @var Request $request */
    protected $request;

    /** @var FilterProvider $filterProvider */
    protected $filterProvider;

    /** @var BlogInterface $blogInterface */
    protected $blogInterface;

    /** @var BlogInterface $blogPost */
    protected $blogPost;

    /**
     * BlogPost constructor.
     * @param Context $context
     * @param BlogRepository $blogRepository
     * @param Request $request
     * @param FilterProvider $filterProvider
     * @param BlogInterface $blogInterface
     * @param array $data
     */
    public function __construct(
        Context $context,
        BlogRepository $blogRepository,
        Request $request,
        FilterProvider $filterProvider,
        BlogInterface $blogInterface,
        array $data = []
    ) {
        $this->blogInterface = $blogInterface;
        $this->request = $request;
        $this->blogRepository = $blogRepository;
        $this->filterProvider = $filterProvider;
        parent::__construct($context, $data);
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        $blogTitle = $this->getBlogPost()->getTitle();

        $this->pageConfig->getTitle()->set($blogTitle);
        return parent::_prepareLayout();
    }

    /**
     * @return BlogInterface
     */
    public function getBlogPost()
    {
        if (!$this->blogPost) {
            $id = $this->request->getParam('id');

            /** @var BlogInterface $blog */
            $this->blogPost = $this->blogRepository->getById($id);
        }

        return $this->blogPost;
    }
}