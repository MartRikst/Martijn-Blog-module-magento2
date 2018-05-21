<?php
namespace Martijn\Blog\Model;

use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Martijn\Blog\Api\Data\BlogInterface;
use Martijn\Blog\Model\ResourceModel\Blog\Collection as BlogResourceDb;
use Martijn\Blog\Model\ResourceModel\BlogResource as BlogResource;

/**
 * Class Blog
 * @package Martijn\Blog\Model
 */
class Blog extends AbstractModel implements IdentityInterface, BlogInterface
{
    const CACHE_TAG = 'martijn_blog';

    /** @var string $_cacheTag */
    protected $_cacheTag = 'martijn_blog';

    /** @var string $_eventPrefix */
    protected $_eventPrefix = 'martijn_blog';

    /** @var UrlInterface $urlBuilder */
    protected $urlBuilder;

    /** @var FilterProvider $filterProvider */
    protected $filterProvider;

    /**
     * Blog constructor.
     * @param Context $context
     * @param Registry $registry
     * @param UrlInterface $urlBuilder
     * @param BlogResource|null $resource
     * @param BlogResourceDb|null $resourceCollection
     * @param FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        UrlInterface $urlBuilder,
        BlogResource $resource = null,
        BlogResourceDb $resourceCollection = null,
        FilterProvider $filterProvider,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );

        $this->urlBuilder = $urlBuilder;
        $this->filterProvider = $filterProvider;
    }

    /**
     * Protected construct
     */
    protected function _construct()
    {
       $this->_init('Martijn\Blog\Model\ResourceModel\BlogResource');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getData(BlogInterface::ID);
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->setData(BlogInterface::ID, $id);
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @inheritdoc
     */
    public function setTitle($title)
    {
        $this->setData('title', $title);
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        $blogContent = $this->getData('content');

        if ($blogContent) {
            try {
                $blogContent = $this->filterProvider
                    ->getBlockFilter()
                    ->filter($blogContent);
            } catch (\Exception $e) {
                // Return unfiltered content, so do nothing
            }
        }
        return $blogContent;
    }


    /**
     * @inheritdoc
     */
    public function setContent($content)
    {
        $this->setData('content', $content);
    }

    /**
     * @inheritdoc
     */
    public function getPostedBy()
    {
        return $this->getData('postedBy');
    }

    /**
     * @inheritdoc
     */
    public function setPostedBy($postedBy)
    {
        $this->setData('postedBy', $postedBy);
    }

    /**
     * @inheritdoc
     */
    public function getDate()
    {
        return $this->getData('date');
    }

    /**
     * @inheritdoc
     */
    public function setDate($date)
    {
       $this->setData('date', $date);
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        $url = $this->urlBuilder->getUrl(
            'blog/posts/blog',
            ['id' => $this->getId()]);

        return $url;
    }
}
