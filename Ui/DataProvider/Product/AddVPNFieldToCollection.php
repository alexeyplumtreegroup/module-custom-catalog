<?php
namespace AlTayer\CustomCatalog\Ui\DataProvider\Product;

class AddVPNFieldToCollection implements \Magento\Ui\DataProvider\AddFieldToCollectionInterface
{
    public function addField(\Magento\Framework\Data\Collection $collection, $field, $alias = null)
    {
        $collection->joinAttribute('vendor_product_number', 'catalog_product/vendor_product_number', 'entity_id', null, 'left');
    }
}