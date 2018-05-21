<?php
namespace Martijn\Blog\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Martijn\Blog\Api\BlogRepositoryInterface;
use Martijn\Blog\Api\Data\BlogInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Martijn\Blog\Model\ResourceModel\BlogResource;
use Martijn\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollection;
use Magento\Framework\Api\SearchResultsInterfaceFactory as SearchResultsFactory;

/**
 * Class BlogRepository
 * @package Martijn\Blog\Model
 */
class BlogRepository implements BlogRepositoryInterface
{
    /** @var BlogInterface $blogInterface */
    protected $blogInterface;

    /** @var BlogFactory $blogFactory */
    protected $blogFactory;

    /** @var BlogResource $blogResource */
    protected $blogResource;

    /** @var blog $blog */
    protected $blog;

    /** @var BlogCollection $blogCollection */
    protected $blogCollection;

    /** @var SearchResultsFactory $searchResultsFactory */
    protected $searchResultsFactory;

    /** @var CollectionProcessorInterface $collectionProcessor*/
    protected $collectionProcessor;

    /**
     * BlogRepository constructor.
     * @param BlogInterface $blogInterface
     * @param BlogFactory $blogFactory
     * @param BlogResource $blogResource
     * @param BlogCollection $blogCollection
     * @param SearchResultsFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param Blog $blog
     */
    public function __construct(
        BlogInterface $blogInterface,
        BlogFactory $blogFactory,
        BlogResource $blogResource,
        BlogCollection $blogCollection,
        SearchResultsFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        Blog $blog
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogInterface = $blogInterface;
        $this->blogResource = $blogResource;
        $this->blogCollection = $blogCollection;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->blog = $blog;
    }

    /**
     * @param $blogId
     * @return Blog
     */
    public function getById($blogId)
    {
        $blogFactory = $this->blogFactory->create();
        $this->blogResource->load($blogFactory, $blogId);

        return $blogFactory;
    }

    /**
     * @param BlogInterface $blog
     * @return BlogInterface
     * @throws \Exception
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(BlogInterface $blog)
    {
        /** @var Blog $blog */
        $this->blogResource->save($blog);

        return $blog;
    }

    /**
     * @param BlogInterface $blog
     * @return BlogInterface
     * @throws \Exception
     */
    public function delete(BlogInterface $blog)
    {
        /** @var Blog $blog */
        $this->blogResource->delete($blog);

        return $blog;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Martijn\Blog\Model\ResourceModel\Blog\Collection $collection */
        $collection = $this->blogCollection->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}