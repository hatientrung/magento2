<?php
namespace Magento\CatalogRule\Model\Resource\Rule;

/**
 * Proxy class for @see \Magento\CatalogRule\Model\Resource\Rule
 */
class Proxy extends \Magento\CatalogRule\Model\Resource\Rule
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
     * @var \Magento\CatalogRule\Model\Resource\Rule
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magento\\CatalogRule\\Model\\Resource\\Rule', $shared = true)
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
     * @return \Magento\CatalogRule\Model\Resource\Rule
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
    public function getRulePrice($date, $wId, $gId, $pId)
    {
        return $this->_getSubject()->getRulePrice($date, $wId, $gId, $pId);
    }

    /**
     * {@inheritdoc}
     */
    public function getRulePrices(\DateTime $date, $websiteId, $customerGroupId, $productIds)
    {
        return $this->_getSubject()->getRulePrices($date, $websiteId, $customerGroupId, $productIds);
    }

    /**
     * {@inheritdoc}
     */
    public function getRulesFromProduct($date, $websiteId, $customerGroupId, $productId)
    {
        return $this->_getSubject()->getRulesFromProduct($date, $websiteId, $customerGroupId, $productId);
    }

    /**
     * {@inheritdoc}
     */
    public function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        return $this->_getSubject()->_beforeSave($object);
    }

    /**
     * {@inheritdoc}
     */
    public function bindRuleToEntity($ruleIds, $entityIds, $entityType)
    {
        return $this->_getSubject()->bindRuleToEntity($ruleIds, $entityIds, $entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function unbindRuleFromEntity($ruleIds, $entityIds, $entityType)
    {
        return $this->_getSubject()->unbindRuleFromEntity($ruleIds, $entityIds, $entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedEntityIds($ruleId, $entityType)
    {
        return $this->_getSubject()->getAssociatedEntityIds($ruleId, $entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function getWebsiteIds($ruleId)
    {
        return $this->_getSubject()->getWebsiteIds($ruleId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerGroupIds($ruleId)
    {
        return $this->_getSubject()->getCustomerGroupIds($ruleId);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdFieldName()
    {
        return $this->_getSubject()->getIdFieldName();
    }

    /**
     * {@inheritdoc}
     */
    public function getMainTable()
    {
        return $this->_getSubject()->getMainTable();
    }

    /**
     * {@inheritdoc}
     */
    public function getTable($tableName)
    {
        return $this->_getSubject()->getTable($tableName);
    }

    /**
     * {@inheritdoc}
     */
    public function getReadConnection()
    {
        return $this->_getSubject()->getReadConnection();
    }

    /**
     * {@inheritdoc}
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        return $this->_getSubject()->load($object, $value, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        return $this->_getSubject()->save($object);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Magento\Framework\Model\AbstractModel $object)
    {
        return $this->_getSubject()->delete($object);
    }

    /**
     * {@inheritdoc}
     */
    public function addUniqueField($field)
    {
        return $this->_getSubject()->addUniqueField($field);
    }

    /**
     * {@inheritdoc}
     */
    public function resetUniqueField()
    {
        return $this->_getSubject()->resetUniqueField();
    }

    /**
     * {@inheritdoc}
     */
    public function unserializeFields(\Magento\Framework\Model\AbstractModel $object)
    {
        return $this->_getSubject()->unserializeFields($object);
    }

    /**
     * {@inheritdoc}
     */
    public function getUniqueFields()
    {
        return $this->_getSubject()->getUniqueFields();
    }

    /**
     * {@inheritdoc}
     */
    public function hasDataChanged($object)
    {
        return $this->_getSubject()->hasDataChanged($object);
    }

    /**
     * {@inheritdoc}
     */
    public function afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        return $this->_getSubject()->afterLoad($object);
    }

    /**
     * {@inheritdoc}
     */
    public function getChecksum($table)
    {
        return $this->_getSubject()->getChecksum($table);
    }

    /**
     * {@inheritdoc}
     */
    public function beginTransaction()
    {
        return $this->_getSubject()->beginTransaction();
    }

    /**
     * {@inheritdoc}
     */
    public function addCommitCallback($callback)
    {
        return $this->_getSubject()->addCommitCallback($callback);
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        return $this->_getSubject()->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function rollBack()
    {
        return $this->_getSubject()->rollBack();
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationRulesBeforeSave()
    {
        return $this->_getSubject()->getValidationRulesBeforeSave();
    }
}
