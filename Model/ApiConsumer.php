<?php
namespace AlTayer\CustomCatalog\Model;

class ApiConsumer implements \Rcason\Mq\Api\ConsumerInterface
{
    protected $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->productFactory = $productFactory;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function process($data)
    {
        $productData = json_decode($data);
        $product = $this->productFactory->create();
        $product->load($productData->entity_id);
        if (!$product->getId()) {
            throw new NoSuchEntityException(__('Requested product doesn\'t exist'));
        }

        $product->setData('vendor_product_number',  $productData->vpn);
        $product->setData('copy_write_info', $productData->copywrite_info);
        $product->setStoreId($productData->store_id);
        $product->save();
    }

}