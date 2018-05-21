<?php
namespace Martijn\Blog\Ui\Component;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Martijn\Blog\Model\ResourceModel\Blog\CollectionFactory;

/**
 * Class DataProvider
 * @package Martijn\Blog\Model
 */
Class DataProvider extends AbstractDataProvider
{
    /** @var CollectionFactory $collectionFactory */
    protected $collection;

    /** @var $loadedData */
    protected $loadedData;

    /**
     * DataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = [])
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if(isset($this_loadedData)) {
            return $this->loadedData;
        }
        $values = $this->collection->getItems();
        foreach($values as $items) {
            $this->loadedData[$items->getId()] = $items->getData();
        }
        return $this->loadedData;
    }
}