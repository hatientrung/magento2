<?php
namespace Magento\Catalog\Model\Resource\Product;

/**
 * Interceptor class for @see \Magento\Catalog\Model\Resource\Product
 */
class Interceptor extends \Magento\Catalog\Model\Resource\Product
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

    public function __construct(\Magento\Eav\Model\Entity\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Catalog\Model\Factory $modelFactory, \Magento\Catalog\Model\Resource\Category\CollectionFactory $categoryCollectionFactory, \Magento\Catalog\Model\Resource\Category $catalogCategory, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Eav\Model\Entity\Attribute\SetFactory $setFactory, \Magento\Eav\Model\Entity\TypeFactory $typeFactory, $data = array())
    {
        $this->___init();
        parent::__construct($context, $storeManager, $modelFactory, $categoryCollectionFactory, $catalogCategory, $eventManager, $setFactory, $typeFactory, $data);
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
    public function getWebsiteIds($product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWebsiteIds');
        if (!$pluginInfo) {
            return parent::getWebsiteIds($product);
        } else {
            return $this->___callPlugins('getWebsiteIds', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getWebsiteIdsByProductIds($productIds)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWebsiteIdsByProductIds');
        if (!$pluginInfo) {
            return parent::getWebsiteIdsByProductIds($productIds);
        } else {
            return $this->___callPlugins('getWebsiteIdsByProductIds', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryIds($product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCategoryIds');
        if (!$pluginInfo) {
            return parent::getCategoryIds($product);
        } else {
            return $this->___callPlugins('getCategoryIds', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIdBySku($sku)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIdBySku');
        if (!$pluginInfo) {
            return parent::getIdBySku($sku);
        } else {
            return $this->___callPlugins('getIdBySku', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete($object)
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
    public function getCategoryCollection($product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCategoryCollection');
        if (!$pluginInfo) {
            return parent::getCategoryCollection($product);
        } else {
            return $this->___callPlugins('getCategoryCollection', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableInCategories($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAvailableInCategories');
        if (!$pluginInfo) {
            return parent::getAvailableInCategories($object);
        } else {
            return $this->___callPlugins('getAvailableInCategories', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultAttributeSourceModel()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultAttributeSourceModel');
        if (!$pluginInfo) {
            return parent::getDefaultAttributeSourceModel();
        } else {
            return $this->___callPlugins('getDefaultAttributeSourceModel', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function canBeShowInCategory($product, $categoryId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canBeShowInCategory');
        if (!$pluginInfo) {
            return parent::canBeShowInCategory($product, $categoryId);
        } else {
            return $this->___callPlugins('canBeShowInCategory', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function duplicate($oldId, $newId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'duplicate');
        if (!$pluginInfo) {
            return parent::duplicate($oldId, $newId);
        } else {
            return $this->___callPlugins('duplicate', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getProductsSku(array $productIds)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductsSku');
        if (!$pluginInfo) {
            return parent::getProductsSku($productIds);
        } else {
            return $this->___callPlugins('getProductsSku', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getProductsIdsBySkus(array $productSkuList)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductsIdsBySkus');
        if (!$pluginInfo) {
            return parent::getProductsIdsBySkus($productSkuList);
        } else {
            return $this->___callPlugins('getProductsIdsBySkus', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getProductEntitiesInfo($columns = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductEntitiesInfo');
        if (!$pluginInfo) {
            return parent::getProductEntitiesInfo($columns);
        } else {
            return $this->___callPlugins('getProductEntitiesInfo', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAssignedImages($product, $storeIds)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAssignedImages');
        if (!$pluginInfo) {
            return parent::getAssignedImages($product, $storeIds);
        } else {
            return $this->___callPlugins('getAssignedImages', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function countAll()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'countAll');
        if (!$pluginInfo) {
            return parent::countAll();
        } else {
            return $this->___callPlugins('countAll', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validate');
        if (!$pluginInfo) {
            return parent::validate($object);
        } else {
            return $this->___callPlugins('validate', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultStoreId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultStoreId');
        if (!$pluginInfo) {
            return parent::getDefaultStoreId();
        } else {
            return $this->___callPlugins('getDefaultStoreId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeRawValue($entityId, $attribute, $store)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributeRawValue');
        if (!$pluginInfo) {
            return parent::getAttributeRawValue($entityId, $attribute, $store);
        } else {
            return $this->___callPlugins('getAttributeRawValue', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function load($object, $entityId, $attributes = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        if (!$pluginInfo) {
            return parent::load($object, $entityId, $attributes);
        } else {
            return $this->___callPlugins('load', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setConnection($read, $write = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setConnection');
        if (!$pluginInfo) {
            return parent::setConnection($read, $write);
        } else {
            return $this->___callPlugins('setConnection', func_get_args(), $pluginInfo);
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
    public function getWriteConnection()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWriteConnection');
        if (!$pluginInfo) {
            return parent::getWriteConnection();
        } else {
            return $this->___callPlugins('getWriteConnection', func_get_args(), $pluginInfo);
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
    public function getTable($alias)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTable');
        if (!$pluginInfo) {
            return parent::getTable($alias);
        } else {
            return $this->___callPlugins('getTable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setType');
        if (!$pluginInfo) {
            return parent::setType($type);
        } else {
            return $this->___callPlugins('setType', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityType()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityType');
        if (!$pluginInfo) {
            return parent::getEntityType();
        } else {
            return $this->___callPlugins('getEntityType', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getType');
        if (!$pluginInfo) {
            return parent::getType();
        } else {
            return $this->___callPlugins('getType', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTypeId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTypeId');
        if (!$pluginInfo) {
            return parent::getTypeId();
        } else {
            return $this->___callPlugins('getTypeId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function unsetAttributes($attributes = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetAttributes');
        if (!$pluginInfo) {
            return parent::unsetAttributes($attributes);
        } else {
            return $this->___callPlugins('unsetAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute($attribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttribute');
        if (!$pluginInfo) {
            return parent::getAttribute($attribute);
        } else {
            return $this->___callPlugins('getAttribute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addAttribute(\Magento\Eav\Model\Entity\Attribute\AbstractAttribute $attribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addAttribute');
        if (!$pluginInfo) {
            return parent::addAttribute($attribute);
        } else {
            return $this->___callPlugins('addAttribute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isPartialLoad($flag = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isPartialLoad');
        if (!$pluginInfo) {
            return parent::isPartialLoad($flag);
        } else {
            return $this->___callPlugins('isPartialLoad', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isPartialSave($flag = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isPartialSave');
        if (!$pluginInfo) {
            return parent::isPartialSave($flag);
        } else {
            return $this->___callPlugins('isPartialSave', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function loadAllAttributes($object = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'loadAllAttributes');
        if (!$pluginInfo) {
            return parent::loadAllAttributes($object);
        } else {
            return $this->___callPlugins('loadAllAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSortedAttributes($setId = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSortedAttributes');
        if (!$pluginInfo) {
            return parent::getSortedAttributes($setId);
        } else {
            return $this->___callPlugins('getSortedAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributesCompare($firstAttribute, $secondAttribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'attributesCompare');
        if (!$pluginInfo) {
            return parent::attributesCompare($firstAttribute, $secondAttribute);
        } else {
            return $this->___callPlugins('attributesCompare', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function walkAttributes($partMethod, array $args = array(), $collectExceptionMessages = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'walkAttributes');
        if (!$pluginInfo) {
            return parent::walkAttributes($partMethod, $args, $collectExceptionMessages);
        } else {
            return $this->___callPlugins('walkAttributes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributesByCode()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributesByCode');
        if (!$pluginInfo) {
            return parent::getAttributesByCode();
        } else {
            return $this->___callPlugins('getAttributesByCode', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributesByTable()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributesByTable');
        if (!$pluginInfo) {
            return parent::getAttributesByTable();
        } else {
            return $this->___callPlugins('getAttributesByTable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityTable()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityTable');
        if (!$pluginInfo) {
            return parent::getEntityTable();
        } else {
            return $this->___callPlugins('getEntityTable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityIdField()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityIdField');
        if (!$pluginInfo) {
            return parent::getEntityIdField();
        } else {
            return $this->___callPlugins('getEntityIdField', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getValueEntityIdField()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValueEntityIdField');
        if (!$pluginInfo) {
            return parent::getValueEntityIdField();
        } else {
            return $this->___callPlugins('getValueEntityIdField', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getValueTablePrefix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValueTablePrefix');
        if (!$pluginInfo) {
            return parent::getValueTablePrefix();
        } else {
            return $this->___callPlugins('getValueTablePrefix', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityTablePrefix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityTablePrefix');
        if (!$pluginInfo) {
            return parent::getEntityTablePrefix();
        } else {
            return $this->___callPlugins('getEntityTablePrefix', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isAttributeStatic($attribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isAttributeStatic');
        if (!$pluginInfo) {
            return parent::isAttributeStatic($attribute);
        } else {
            return $this->___callPlugins('isAttributeStatic', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setNewIncrementId(\Magento\Framework\Object $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setNewIncrementId');
        if (!$pluginInfo) {
            return parent::setNewIncrementId($object);
        } else {
            return $this->___callPlugins('setNewIncrementId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function checkAttributeUniqueValue(\Magento\Eav\Model\Entity\Attribute\AbstractAttribute $attribute, $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'checkAttributeUniqueValue');
        if (!$pluginInfo) {
            return parent::checkAttributeUniqueValue($attribute, $object);
        } else {
            return $this->___callPlugins('checkAttributeUniqueValue', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Framework\Object $object)
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
    public function saveAttribute(\Magento\Framework\Object $object, $attributeCode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveAttribute');
        if (!$pluginInfo) {
            return parent::saveAttribute($object, $attributeCode);
        } else {
            return $this->___callPlugins('saveAttribute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultAttributes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultAttributes');
        if (!$pluginInfo) {
            return parent::getDefaultAttributes();
        } else {
            return $this->___callPlugins('getDefaultAttributes', func_get_args(), $pluginInfo);
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
