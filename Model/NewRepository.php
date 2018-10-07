<?php
namespace AlTayer\CustomCatalog\Model;


class NewRepository extends \Magento\Catalog\Model\ProductRepository
{
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

        foreach ($productCollection as $product){
            echo $product->getName() . "\n";
        }
    }

}