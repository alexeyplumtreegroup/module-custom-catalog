<?php
namespace AlTayer\CustomCatalog\Api;

interface CustomInterface
{
    /**
     * Get product list
     *
     * @param string $vpn
     * @return string
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