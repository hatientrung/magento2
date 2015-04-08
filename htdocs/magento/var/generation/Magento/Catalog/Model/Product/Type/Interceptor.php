<?php
namespace Magento\Catalog\Model\Product\Type;

/**
 * Interceptor class for @see \Magento\Catalog\Model\Product\Type
 */
class Interceptor extends \Magento\Catalog\Model\Product\Type
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

    public function __construct(\Magento\Catalog\Model\ProductTypes\ConfigInterface $config, \Magento\Catalog\Model\Product\Type\Pool $productTypePool, \Magento\Catalog\Model\Product\Type\Price\Factory $priceFactory, \Magento\Framework\Pricing\PriceInfo\Factory $priceInfoFactory)
    {
        $this->___init();
        parent::__construct($config, $productTypePool, $priceFactory, $priceInfoFactory);
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
    public function factory($product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'factory');
        if (!$pluginInfo) {
            return parent::factory($product);
        } else {
            return $this->___callPlugins('factory', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function priceFactory($productType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'priceFactory');
        if (!$pluginInfo) {
            return parent::priceFactory($productType);
        } else {
            return $this->___callPlugins('priceFactory', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getPriceInfo(\Magento\Catalog\Model\Product $saleableItem)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPriceInfo');
        if (!$pluginInfo) {
            return parent::getPriceInfo($saleableItem);
        } else {
            return $this->___callPlugins('getPriceInfo', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionArray()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOptionArray');
        if (!$pluginInfo) {
            return parent::getOptionArray();
        } else {
            return $this->___callPlugins('getOptionArray', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAllOption()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAllOption');
        if (!$pluginInfo) {
            return parent::getAllOption();
        } else {
            return $this->___callPlugins('getAllOption', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAllOptions()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAllOptions');
        if (!$pluginInfo) {
            return parent::getAllOptions();
        } else {
            return $this->___callPlugins('getAllOptions', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOptions');
        if (!$pluginInfo) {
            return parent::getOptions();
        } else {
            return $this->___callPlugins('getOptions', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionText($optionId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOptionText');
        if (!$pluginInfo) {
            return parent::getOptionText($optionId);
        } else {
            return $this->___callPlugins('getOptionText', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTypes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTypes');
        if (!$pluginInfo) {
            return parent::getTypes();
        } else {
            return $this->___callPlugins('getTypes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCompositeTypes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCompositeTypes');
        if (!$pluginInfo) {
            return parent::getCompositeTypes();
        } else {
            return $this->___callPlugins('getCompositeTypes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTypesByPriority()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTypesByPriority');
        if (!$pluginInfo) {
            return parent::getTypesByPriority();
        } else {
            return $this->___callPlugins('getTypesByPriority', func_get_args(), $pluginInfo);
        }
    }
}
