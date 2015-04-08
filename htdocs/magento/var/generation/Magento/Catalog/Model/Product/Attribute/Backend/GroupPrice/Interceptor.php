<?php
namespace Magento\Catalog\Model\Product\Attribute\Backend\GroupPrice;

/**
 * Interceptor class for @see
 * \Magento\Catalog\Model\Product\Attribute\Backend\GroupPrice
 */
class Interceptor extends \Magento\Catalog\Model\Product\Attribute\Backend\GroupPrice
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

    public function __construct(\Magento\Directory\Model\CurrencyFactory $currencyFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Catalog\Helper\Data $catalogData, \Magento\Framework\App\Config\ScopeConfigInterface $config, \Magento\Catalog\Model\Product\Type $catalogProductType, \Magento\Customer\Api\GroupManagementInterface $groupManagement, \Magento\Catalog\Model\Resource\Product\Attribute\Backend\GroupPrice $productAttributeBackendGroupPrice)
    {
        $this->___init();
        parent::__construct($currencyFactory, $storeManager, $catalogData, $config, $catalogProductType, $groupManagement, $productAttributeBackendGroupPrice);
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
    public function isScalar()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isScalar');
        if (!$pluginInfo) {
            return parent::isScalar();
        } else {
            return $this->___callPlugins('isScalar', func_get_args(), $pluginInfo);
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
    public function preparePriceData(array $priceData, $productTypeId, $websiteId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'preparePriceData');
        if (!$pluginInfo) {
            return parent::preparePriceData($priceData, $productTypeId, $websiteId);
        } else {
            return $this->___callPlugins('preparePriceData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterLoad($object)
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
    public function afterSave($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterSave');
        if (!$pluginInfo) {
            return parent::afterSave($object);
        } else {
            return $this->___callPlugins('afterSave', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAffectedFields($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAffectedFields');
        if (!$pluginInfo) {
            return parent::getAffectedFields($object);
        } else {
            return $this->___callPlugins('getAffectedFields', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute($attribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setAttribute');
        if (!$pluginInfo) {
            return parent::setAttribute($attribute);
        } else {
            return $this->___callPlugins('setAttribute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setScope($attribute)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setScope');
        if (!$pluginInfo) {
            return parent::setScope($attribute);
        } else {
            return $this->___callPlugins('setScope', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttribute');
        if (!$pluginInfo) {
            return parent::getAttribute();
        } else {
            return $this->___callPlugins('getAttribute', func_get_args(), $pluginInfo);
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
    public function isStatic()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isStatic');
        if (!$pluginInfo) {
            return parent::isStatic();
        } else {
            return $this->___callPlugins('isStatic', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTable');
        if (!$pluginInfo) {
            return parent::getTable();
        } else {
            return $this->___callPlugins('getTable', func_get_args(), $pluginInfo);
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
    public function setValueId($valueId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setValueId');
        if (!$pluginInfo) {
            return parent::setValueId($valueId);
        } else {
            return $this->___callPlugins('setValueId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityValueId($entity, $valueId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setEntityValueId');
        if (!$pluginInfo) {
            return parent::setEntityValueId($entity, $valueId);
        } else {
            return $this->___callPlugins('setEntityValueId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getValueId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getValueId');
        if (!$pluginInfo) {
            return parent::getValueId();
        } else {
            return $this->___callPlugins('getValueId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityValueId($entity)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEntityValueId');
        if (!$pluginInfo) {
            return parent::getEntityValueId($entity);
        } else {
            return $this->___callPlugins('getEntityValueId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultValue()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultValue');
        if (!$pluginInfo) {
            return parent::getDefaultValue();
        } else {
            return $this->___callPlugins('getDefaultValue', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beforeSave');
        if (!$pluginInfo) {
            return parent::beforeSave($object);
        } else {
            return $this->___callPlugins('beforeSave', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'beforeDelete');
        if (!$pluginInfo) {
            return parent::beforeDelete($object);
        } else {
            return $this->___callPlugins('beforeDelete', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterDelete($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterDelete');
        if (!$pluginInfo) {
            return parent::afterDelete($object);
        } else {
            return $this->___callPlugins('afterDelete', func_get_args(), $pluginInfo);
        }
    }
}
