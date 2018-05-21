<?php
namespace Martijn\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * Class BlogResource
 * @package Martijn\Blog\Model\ResourceModel
 */
class BlogResource extends AbstractDb
{
    /**
     * Blog constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Protected constructor
     */
    protected function _construct()
    {
       $this->_init('martijn_blog', 'id');
    }
}