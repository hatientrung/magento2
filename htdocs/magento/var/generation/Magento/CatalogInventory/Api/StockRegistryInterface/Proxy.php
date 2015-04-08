<?php
namespace Magento\CatalogInventory\Api\StockRegistryInterface;

/**
 * Proxy class for @see \Magento\CatalogInventory\Api\StockRegistryInterface
 */
class Proxy implements \Magento\CatalogInventory\Api\StockRegistryInterface
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
     * @var \Magento\CatalogInventory\Api\StockRegistryInterface
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magento\\CatalogInventory\\Api\\StockRegistryInterface', $shared = true)
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
     * @return \Magento\CatalogInventory\Api\StockRegistryInterface
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
    public function getStock($websiteId = null)
    {
        return $this->_getSubject()->getStock($websiteId);
    }

    /**
     * {@inheritdoc}
     */
    public function getStockItem($productId, $websiteId = null)
    {
        return $this->_getSubject()->getStockItem($productId, $websiteId);
    }

    /**
     * {@inheritdoc}
     */
    public function getStockItemBySku($productSku, $websiteId = null)
    {
        return $this->_getSubject()->getStockItemBySku($productSku, $websiteId);
    }

    /**
     * {@inheritdoc}
     */
    public function getStockStatus($productId, $websiteId = null)
    {
        return $this->_getSubject()->getStockStatus($productId, $websiteId);
    }

    /**
     * {@inheritdoc}
     */
    public function getStockStatusBySku($productSku, $websiteId = null)
    {
        return $this->_getSubject()->getStockStatusBySku($productSku, $websiteId);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductStockStatus($productId, $websiteId = null)
    {
        return $this->_getSubject()->getProductStockStatus($productId, $websiteId);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductStockStatusBySku($productSku, $websiteId = null)
    {
        return $this->_getSubject()->getProductStockStatusBySku($productSku, $websiteId);
    }

    /**
     * {@inheritdoc}
     */
    public function getLowStockItems($websiteId, $qty, $currentPage = 1, $pageSize = 0)
    {
        return $this->_getSubject()->getLowStockItems($websiteId, $qty, $currentPage, $pageSize);
    }

    /**
     * {@inheritdoc}
     */
    public function updateStockItemBySku($productSku, \Magento\CatalogInventory\Api\Data\StockItemInterface $stockItem)
    {
        return $this->_getSubject()->updateStockItemBySku($productSku, $stockItem);
    }
}
