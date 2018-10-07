<?php
namespace AlTayer\CustomCatalog\Ui\DataProvider\Product;

class AddCopyWriteInfoFieldToCollection implements \Magento\Ui\DataProvider\AddFieldToCollectionInterface
{
    public function addField(\Magento\Framework\Data\Collection $collection, $field, $alias = null)
    {
       // die("hello");
        $collection->joinAttribute('copy_write_info', 'catalog_product/copy_write_info', 'entity_id', null, 'left');
       /* $collection->joinField(
            'copy_write_info',
            'cataloginventory_stock_item',
            'manage_stock',
            'product_id=entity_id',
            null,
            'left'
        );*/
    }
}