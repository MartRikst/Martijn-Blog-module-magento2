<?php
namespace Martijn\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Martijn\Blog\Api\BlogRepositoryInterface as BlogRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;

/**
 * Class Post
 * @package Martijn\Blog\Block
 */
class Post extends Template
{
    /** @var BlogRepository $blogRepository */
    protected $blogRepository;

    /** @var SearchCriteriaBuilder $searchCriteria */
    protected $searchCriteria;

    /**
     * Post constructor.
     * @param Context $context
     * @param BlogRepository $blogRepository
     * @param SearchCriteriaBuilder $searchCriteria
     * @param array $data
     */
    public function __construct(
        Context $context,
        BlogRepository $blogRepository,
        SearchCriteriaBuilder $searchCriteria,
        array $data = []
    ) {
        $this->blogRepository = $blogRepository;
        $this->searchCriteria = $searchCriteria;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getBlogPosts()
    {
        $searchCriteria = $this->searchCriteria->create();
        $blogCollection = $this->blogRepository->getList($searchCriteria)
            ->getItems();

       return $blogCollection;
    }
}