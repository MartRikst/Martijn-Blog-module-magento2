<?php
namespace Martijn\Blog\Block\Adminhtml\Blog\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;

/**
 * Class GenericButton
 * @package Martijn\Blog\Block\Adminhtml\Blog\Edit
 */
class GenericButton
{
    /** @var UrlInterface $urlBuilder */
    protected $urlBuilder;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        Context $context,
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
