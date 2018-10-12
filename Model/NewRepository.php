<?php
namespace AlTayer\CustomCatalog\Model;

use Magento\Framework\Api\ImageContentValidatorInterface;
use Magento\Framework\Api\Data\ImageContentInterfaceFactory;
use Magento\Catalog\Model\Product\Gallery\MimeTypeExtensionMap;
use Magento\Framework\Api\ImageProcessorInterface;


class NewRepository extends \Magento\Catalog\Model\ProductRepository
{

    protected $jsonHelper;

    public function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper $initializationHelper,
        \Magento\Catalog\Api\Data\ProductSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Catalog\Api\ProductAttributeRepositoryInterface $attributeRepository,
        \Magento\Catalog\Model\ResourceModel\Product $resourceModel,
        \Magento\Catalog\Model\Product\Initialization\Helper\ProductLinks $linkInitializer,
        \Magento\Catalog\Model\Product\LinkTypeProvider $linkTypeProvider,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Catalog\Api\ProductAttributeRepositoryInterface $metadataServiceInterface,
        \Magento\Framework\Api\ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        \Magento\Catalog\Model\Product\Option\Converter $optionConverter,
        \Magento\Framework\Filesystem $fileSystem,
        ImageContentValidatorInterface $contentValidator,
        ImageContentInterfaceFactory $contentFactory,
        MimeTypeExtensionMap $mimeTypeExtensionMap,
        ImageProcessorInterface $imageProcessor,
        \Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface $extensionAttributesJoinProcessor,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    )
    {
        $this->productFactory = $productFactory;
        $this->jsonHelper = $jsonHelper;
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

        foreach ($productCollection as $product){
            echo $product->getName() . "\n";
        }
    }

    public function update($data)
    {
        $product = $this->productFactory->create();
        $product->load($data["entity_id"]);
        if (!$product->getId()) {
            throw new NoSuchEntityException(__('Requested product doesn\'t exist'));
        }
        $product->setData('vendor_product_number', $data["vpn"]);
        $product->setData('copy_write_info', $data["copywrite_info"]);
        $product->setStoreId(0);
        $product->save();

    }

}