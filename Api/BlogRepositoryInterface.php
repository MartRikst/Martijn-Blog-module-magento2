<?php
namespace Martijn\Blog\Api;

use Martijn\Blog\Api\Data\BlogInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface BlogRepositoryInterface
 * @package Martijn\Blog\Api
 */
interface BlogRepositoryInterface
{
    /**
     * @param int $blogId
     * @return mixed
     */
    public function getById($blogId);

    /**
     * @param BlogInterface $blog
     * @return mixed
     */
    public function save(BlogInterface $blog);

    /**
     * @param BlogInterface $blog
     * @return mixed
     */
    public function delete(BlogInterface $blog);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

}

