<?php
namespace AlTayer\CustomCatalog\Model;

class CustomRepository implements \AlTayer\CustomCatalog\Api\CustomInterface
{
    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Rcason\Mq\Api\PublisherInterface
     */
    protected $publisher;

    /**
     * @param ResourceModel\Product\CollectionFactory $collectionFactory
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param \Rcason\Mq\Api\PublisherInterface $publisher
     */
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Rcason\Mq\Api\PublisherInterface $publisher
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->jsonHelper = $jsonHelper;
        $this->publisher = $publisher;
    }

    /**
     * {@inheritdoc}
     */
    public function getByVPN($vpn)
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $collection */
        $collection = $this->collectionFactory->create();
        $productCollection = $collection
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('vendor_product_number', $vpn)
            ->load();

        $response = [];
        foreach ($productCollection as $product){
            $response[] = array($product->getId() => $product->getName());
        }
        return json_encode($response, true);
    }

    public function update($data)
    {
        $this->publisher->publish('product.update', json_encode($data));
    }

}