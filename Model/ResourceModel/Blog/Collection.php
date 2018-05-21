<?php

namespace Martijn\Blog\Model\ResourceModel\Blog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Martijn\Blog\Model\ResourceModel\Blog
 */
class Collection extends AbstractCollection
{
    /** @var string $_idFieldName */
    protected $_idFieldName = 'id';

    /** @var string $_eventPrefix */
    protected $_eventPrefix = 'martijn_blog_collection';

    /** @var string $_eventObject */
    protected $_eventObject = 'blog_collection';

    /**
     * Protected constructor
     */
    protected function _construct()
    {
        $this->_init('Martijn\Blog\Model\Blog',
            'Martijn\Blog\Model\ResourceModel\BlogResource');
    }
}