<?php
namespace Magento\Weee\Helper\Data;

/**
 * Proxy class for @see \Magento\Weee\Helper\Data
 */
class Proxy extends \Magento\Weee\Helper\Data
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Magento\Weee\Helper\Data
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magento\\Weee\\Helper\\Data', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return array('_subject', '_isShared');
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Magento\Weee\Helper\Data
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriceDisplayType($store = null)
    {
        return $this->_getSubject()->getPriceDisplayType($store);
    }

    /**
     * {@inheritdoc}
     */
    public function getListPriceDisplayType($store = null)
    {
        return $this->_getSubject()->getListPriceDisplayType($store);
    }

    /**
     * {@inheritdoc}
     */
    public function getSalesPriceDisplayType($store = null)
    {
        return $this->_getSubject()->getSalesPriceDisplayType($store);
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailPriceDisplayType($store = null)
    {
        return $this->_getSubject()->getEmailPriceDisplayType($store);
    }

    /**
     * {@inheritdoc}
     */
    public function isTaxable($store = null)
    {
        return $this->_getSubject()->isTaxable($store);
    }

    /**
     * {@inheritdoc}
     */
    public function includeInSubtotal($store = null)
    {
        return $this->_getSubject()->includeInSubtotal($store);
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled($store = null)
    {
        return $this->_getSubject()->isEnabled($store);
    }

    /**
     * {@inheritdoc}
     */
    public function displayTotalsInclTax($store = null)
    {
        return $this->_getSubject()->displayTotalsInclTax($store);
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount($product, $website = null)
    {
        return $this->_getSubject()->getAmount($product, $website);
    }

    /**
     * {@inheritdoc}
     */
    public function typeOfDisplay($compareTo = null, $zone = null, $store = null)
    {
        return $this->_getSubject()->typeOfDisplay($compareTo, $zone, $store);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductWeeeAttributes($product, $shipping = null, $billing = null, $website = null, $calculateTaxes = false)
    {
        return $this->_getSubject()->getProductWeeeAttributes($product, $shipping, $billing, $website, $calculateTaxes);
    }

    /**
     * {@inheritdoc}
     */
    public function getApplied($item)
    {
        return $this->_getSubject()->getApplied($item);
    }

    /**
     * {@inheritdoc}
     */
    public function setApplied($item, $value)
    {
        return $this->_getSubject()->setApplied($item, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductWeeeAttributesForDisplay($product)
    {
        return $this->_getSubject()->getProductWeeeAttributesForDisplay($product);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductWeeeAttributesForRenderer($product, $shipping = null, $billing = null, $website = null, $calculateTaxes = false)
    {
        return $this->_getSubject()->getProductWeeeAttributesForRenderer($product, $shipping, $billing, $website, $calculateTaxes);
    }

    /**
     * {@inheritdoc}
     */
    public function getAmountForDisplay($product)
    {
        return $this->_getSubject()->getAmountForDisplay($product);
    }

    /**
     * {@inheritdoc}
     */
    public function getAmountInclTaxes($attributes)
    {
        return $this->_getSubject()->getAmountInclTaxes($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeeeTaxInclTax($item)
    {
        return $this->_getSubject()->getWeeeTaxInclTax($item);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseWeeeTaxInclTax($item)
    {
        return $this->_getSubject()->getBaseWeeeTaxInclTax($item);
    }

    /**
     * {@inheritdoc}
     */
    public function getRowWeeeTaxInclTax($item)
    {
        return $this->_getSubject()->getRowWeeeTaxInclTax($item);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseRowWeeeTaxInclTax($item)
    {
        return $this->_getSubject()->getBaseRowWeeeTaxInclTax($item);
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalTaxAppliedForWeeeTax($item)
    {
        return $this->_getSubject()->getTotalTaxAppliedForWeeeTax($item);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseTotalTaxAppliedForWeeeTax($item)
    {
        return $this->_getSubject()->getBaseTotalTaxAppliedForWeeeTax($item);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeeeAmountInvoiced($orderItem)
    {
        return $this->_getSubject()->getWeeeAmountInvoiced($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseWeeeAmountInvoiced($orderItem)
    {
        return $this->_getSubject()->getBaseWeeeAmountInvoiced($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeeeTaxAmountInvoiced($orderItem)
    {
        return $this->_getSubject()->getWeeeTaxAmountInvoiced($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseWeeeTaxAmountInvoiced($orderItem)
    {
        return $this->_getSubject()->getBaseWeeeTaxAmountInvoiced($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeeeAmountRefunded($orderItem)
    {
        return $this->_getSubject()->getWeeeAmountRefunded($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseWeeeAmountRefunded($orderItem)
    {
        return $this->_getSubject()->getBaseWeeeAmountRefunded($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeeeTaxAmountRefunded($orderItem)
    {
        return $this->_getSubject()->getWeeeTaxAmountRefunded($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseWeeeTaxAmountRefunded($orderItem)
    {
        return $this->_getSubject()->getBaseWeeeTaxAmountRefunded($orderItem);
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalAmounts($items, $store = null)
    {
        return $this->_getSubject()->getTotalAmounts($items, $store);
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        return $this->_getSubject()->isModuleOutputEnabled($moduleName);
    }
}
