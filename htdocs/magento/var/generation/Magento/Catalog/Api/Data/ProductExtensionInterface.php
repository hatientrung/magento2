<?php
namespace Magento\Catalog\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Catalog\Api\Data\ProductInterface
 */
interface ProductExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\Bundle\Api\Data\OptionInterface[]
     */
    public function getBundleProductOptions();

    /**
     * @param \Magento\Bundle\Api\Data\OptionInterface[] $bundleProductOptions
     * @return $this
     */
    public function setBundleProductOptions($bundleProductOptions);

    /**
     * @return integer
     */
    public function getPriceType();

    /**
     * @param integer $priceType
     * @return $this
     */
    public function setPriceType($priceType);

    /**
     * @return string
     */
    public function getPriceView();

    /**
     * @param string $priceView
     * @return $this
     */
    public function setPriceView($priceView);
}
