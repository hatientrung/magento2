<?php
namespace Magento\Catalog\Api\Data;

/**
 * Extension class for @see \Magento\Catalog\Api\Data\ProductInterface
 */
class ProductExtension extends \Magento\Framework\Api\AbstractSimpleObject implements \Magento\Catalog\Api\Data\ProductExtensionInterface
{
    /**
     * @return \Magento\Bundle\Api\Data\OptionInterface[]
     */
    public function getBundleProductOptions()
    {
        return $this->_get('bundle_product_options');
    }

    /**
     * @param \Magento\Bundle\Api\Data\OptionInterface[] $bundleProductOptions
     * @return $this
     */
    public function setBundleProductOptions($bundleProductOptions)
    {
        $this->setData('bundle_product_options', $bundleProductOptions);
        return $this;
    }

    /**
     * @return integer
     */
    public function getPriceType()
    {
        return $this->_get('price_type');
    }

    /**
     * @param integer $priceType
     * @return $this
     */
    public function setPriceType($priceType)
    {
        $this->setData('price_type', $priceType);
        return $this;
    }

    /**
     * @return string
     */
    public function getPriceView()
    {
        return $this->_get('price_view');
    }

    /**
     * @param string $priceView
     * @return $this
     */
    public function setPriceView($priceView)
    {
        $this->setData('price_view', $priceView);
        return $this;
    }
}
