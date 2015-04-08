<?php
namespace Magento\Eav\Model\Resource\Entity\Attribute;

/**
 * Interceptor class for @see \Magento\Eav\Model\Resource\Entity\Attribute
 */
class Interceptor extends \Magento\Eav\Model\Resource\Entity\Attribute
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $pluginLocator = null;

    /**
     * List of plugins
     *
     * @var \Magento\Framework\Interception\PluginListInterface
     */
    protected $pluginList = null;

    /**
     * Invocation chain
     *
     * @var \Magento\Framework\Interception\ChainInterface
     */
    protected $chain = null;

    /**
     * Subject type name
     *
     * @var string
     */
    protected $subjectType = null;

    public function __construct(\Magento\Framework\Model\Resource\Db\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Eav\Model\Resource\Entity\Type $eavEntityType, $resourcePrefix = null)
    {
        $this->___init();
        parent::__construct($context, $storeManager, $eavEntityType, $resourcePrefix);
    }

    public function ___init()
    {
        $this->pluginLocator = \Magento\Framework\App\ObjectManager::getInstance();
        $this->pluginList = $this->pluginLocator->get('Magento\Framework\Interception\PluginListInterface');
        $this->chain = $this->pluginLocator->get('Magento\Framework\Interception\ChainInterface');
        $this->subjectType = get_parent_class($this);
        if (method_exists($this->subjectType, '___init')) {
            parent::___init();
        }
    }

    public function ___callParent($method, array $arguments)
    {
        return call_user_func_array(array('parent', $method), $arguments);
    }

    public function __sleep()
    {
        if (method_exists(get_parent_class($this), '__sleep')) {
            return array_diff(parent::__sleep(), array('pluginLocator', 'pluginList', 'chain', 'subjectType'));
        } else {
            return array_keys(get_class_vars(get_parent_class($this)));
        }
    }

    public function __wakeup()
    {
        $this->___init();
    }

    protected function ___callPlugins($method, array $arguments, array $pluginInfo)
    {
        $capMethod = ucfirst($method);
        $result = null;
        if (isset($pluginInfo[\Magento\Framework\Interception\DefinitionInterface::LISTENER_BEFORE])) {
            // Call 'before' listeners
            foreach ($pluginInfo[\Magento\Framework\Interception\DefinitionInterface::LISTENER_BEFORE] as $code) {
                $beforeResult = call_user_func_array(
                    array($this->pluginList->getPlugin($this->subjectType, $code), 'before'. $capMethod), array_merge(array($this), $arguments)
                );
                if ($beforeResult) {
                    $arguments = $beforeResult;
                }
            }
        }
        if (isset($pluginInfo[\Magento\Framework\Interception\DefinitionInterface::LISTENER_AROUND])) {
            // Call 'around' listener
            $chain = $this->chain;
            $type = $this->subjectType;
            $subject = $this;
            $code = $pluginInfo[\Magento\Framework\Interception\DefinitionInterface::LISTENER_AROUND];
            $next = function () use ($chain, $type, $method, $subject, $code) {
                return $chain->invokeNext($type, $method, $subject, func_get_args(), $code);
            };
            $result = call_user_func_array(
                array($this->pluginList->getPlugin($this->subjectType, $code), 'around' . $capMethod),
                array_merge(array($this, $next), $arguments)
            );
        } else {
            // Call original method
            $result = call_user_func_array(array('parent', $method), $arguments);
        }
        if (isset($pluginInfo[\Magento\Framework\Interception\DefinitionInterface::LISTENER_AFTER])) {
            // Call 'after' listeners
            foreach ($pluginInfo[\Magento\Framework\Interception\DefinitionInterface::LISTENER_AFTER] as $code) {
                $result = $this->pluginList->getPlugin($this->subjectType, $code)
                    ->{'after' . $capMethod}($this, $result);
            }
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function loadByCode(\Magento\Framework\Model\AbstractModel $object, $entityTypeId, $code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'loadByCode');
        if (!$pluginInfo) {
            return parent::loadByCode($object, $entityTypeId, $code);
        } else {
            return $this->___callPlugins('loadByCode', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deleteEntity(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'deleteEntity');
        if (!$pluginInfo) {
            return parent::deleteEntity($object);
        } else {
            return $this->___callPlugins('deleteEntity', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveInSetIncluding(\Magento\Framework\Model\AbstractModel $object, $attributeEntityId = null, $attributeSetId = null, $attributeGroupId = null, $attributeSortOrder = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveInSetIncluding');
        if (!$pluginInfo) {
            return parent::saveInSetIncluding($object, $attributeEntityId, $attributeSetId, $attributeGroupId, $attributeSortOrder);
        } else {
            return $this->___callPlugins('saveInSetIncluding', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIdByCode($entityType, $code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIdByCode');
        if (!$pluginInfo) {
            return parent::getIdByCode($entityType, $code);
        } else {
            return $this->___callPlugins('getIdByCode', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeCodesByFrontendType($frontendType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributeCodesByFrontendType');
        if (!$pluginInfo) {
            return parent::getAttributeCodesByFrontendType($frontendType);
        } else {
            return $this->___callPlugins('getAttributeCodesByFrontendType', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFlatUpdateSelect(\Magento\Eav\Model\Entity\Attribute\AbstractAttribute $attribute, $storeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFlatUpdateSelect');
        if (!$pluginInfo) {
            return parent::getFlatUpdateSelect($attribute, $storeId);
        } else {
            return $this->___callPlugins('getFlatUpdateSelect', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function describeTable($table)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'describeTable');
        if (!$pluginInfo) {
            return parent::describeTable($table);
        } else {
            return $this->___callPlugins('describeTable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAdditionalAttributeTable($entityTypeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAdditionalAttributeTable');
        if (!$pluginInfo) {
            return parent::getAdditionalAttributeTable($entityTypeId);
        } else {
            return $this->___callPlugins('getAdditionalAttributeTable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreLabelsByAttributeId($attributeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStoreLabelsByAttributeId');
        if (!$pluginInfo) {
            return parent::getStoreLabelsByAttributeId($attributeId);
        } else {
            return $this->___callPlugins('getStoreLabelsByAttributeId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getValidAttributeIds($attributeIds)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValidAttributeIds');
        if (!$pluginInfo) {
            return parent::getValidAttributeIds($attributeIds);
        } else {
            return $this->___callPlugins('getValidAttributeIds', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIdFieldName()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIdFieldName');
        if (!$pluginInfo) {
            return parent::getIdFieldName();
        } else {
            return $this->___callPlugins('getIdFieldName', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMainTable()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMainTable');
        if (!$pluginInfo) {
            return parent::getMainTable();
        } else {
            return $this->___callPlugins('getMainTable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTable($tableName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTable');
        if (!$pluginInfo) {
            return parent::getTable($tableName);
        } else {
            return $this->___callPlugins('getTable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getReadConnection()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getReadConnection');
        if (!$pluginInfo) {
            return parent::getReadConnection();
        } else {
            return $this->___callPlugins('getReadConnection', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        if (!$pluginInfo) {
            return parent::load($object, $value, $field);
        } else {
            return $this->___callPlugins('load', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        if (!$pluginInfo) {
            return parent::save($object);
        } else {
            return $this->___callPlugins('save', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'delete');
        if (!$pluginInfo) {
            return parent::delete($object);
        } else {
            return $this->___callPlugins('delete', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addUniqueField($field)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addUniqueField');
        if (!$pluginInfo) {
            return parent::addUniqueField($field);
        } else {
            return $this->___callPlugins('addUniqueField', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function resetUniqueField()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resetUniqueField');
        if (!$pluginInfo) {
            return parent::resetUniqueField();
        } else {
            return $this->___callPlugins('resetUniqueField', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function unserializeFields(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unserializeFields');
        if (!$pluginInfo) {
            return parent::unserializeFields($object);
        } else {
            return $this->___callPlugins('unserializeFields', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUniqueFields()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUniqueFields');
        if (!$pluginInfo) {
            return parent::getUniqueFields();
        } else {
            return $this->___callPlugins('getUniqueFields', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasDataChanged($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasDataChanged');
        if (!$pluginInfo) {
            return parent::hasDataChanged($object);
        } else {
            return $this->___callPlugins('hasDataChanged', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterLoad');
        if (!$pluginInfo) {
            return parent::afterLoad($object);
        } else {
            return $this->___callPlugins('afterLoad', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getChecksum($table)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChecksum');
        if (!$pluginInfo) {
            return parent::getChecksum($table);
        } else {
            return $this->___callPlugins('getChecksum', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function beginTransaction()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beginTransaction');
        if (!$pluginInfo) {
            return parent::beginTransaction();
        } else {
            return $this->___callPlugins('beginTransaction', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addCommitCallback($callback)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addCommitCallback');
        if (!$pluginInfo) {
            return parent::addCommitCallback($callback);
        } else {
            return $this->___callPlugins('addCommitCallback', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'commit');
        if (!$pluginInfo) {
            return parent::commit();
        } else {
            return $this->___callPlugins('commit', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rollBack()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'rollBack');
        if (!$pluginInfo) {
            return parent::rollBack();
        } else {
            return $this->___callPlugins('rollBack', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationRulesBeforeSave()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValidationRulesBeforeSave');
        if (!$pluginInfo) {
            return parent::getValidationRulesBeforeSave();
        } else {
            return $this->___callPlugins('getValidationRulesBeforeSave', func_get_args(), $pluginInfo);
        }
    }
}
