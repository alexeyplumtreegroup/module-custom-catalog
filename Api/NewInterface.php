<?php
namespace AlTayer\CustomCatalog\Api;

use Magento\Catalog\Api\ProductRepositoryInterface;

interface NewInterface extends ProductRepositoryInterface
{
    /**
     * Get product list
     *
     * @param string $vpn
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     */
    public function getByVPN($vpn);

    /**
     * update product by id
     *
     * @param mixed $data
     * @return void
     */
    public function update($data);

}