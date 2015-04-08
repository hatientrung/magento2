<?php
namespace Magento\Checkout\Model\Type\Onepage;

/**
 * Interceptor class for @see \Magento\Checkout\Model\Type\Onepage
 */
class Interceptor extends \Magento\Checkout\Model\Type\Onepage
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

    public function __construct(\Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Checkout\Helper\Data $helper, \Magento\Customer\Model\Url $customerUrl, \Psr\Log\LoggerInterface $logger, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Customer\Model\Session $customerSession, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\RequestInterface $request, \Magento\Customer\Model\AddressFactory $customrAddrFactory, \Magento\Customer\Model\FormFactory $customerFormFactory, \Magento\Customer\Model\CustomerFactory $customerFactory, \Magento\Sales\Model\OrderFactory $orderFactory, \Magento\Framework\Object\Copy $objectCopyService, \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Customer\Model\Metadata\FormFactory $formFactory, \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerDataFactory, \Magento\Framework\Math\Random $mathRandom, \Magento\Framework\Encryption\EncryptorInterface $encryptor, \Magento\Customer\Api\AddressRepositoryInterface $addressRepository, \Magento\Customer\Api\AccountManagementInterface $accountManagement, \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Magento\Framework\Api\ExtensibleDataObjectConverter $extensibleDataObjectConverter, \Magento\Quote\Model\QuoteManagement $quoteManagement, \Magento\Framework\Api\DataObjectHelper $dataObjectHelper)
    {
        $this->___init();
        parent::__construct($eventManager, $helper, $customerUrl, $logger, $checkoutSession, $customerSession, $storeManager, $request, $customrAddrFactory, $customerFormFactory, $customerFactory, $orderFactory, $objectCopyService, $messageManager, $formFactory, $customerDataFactory, $mathRandom, $encryptor, $addressRepository, $accountManagement, $orderSender, $customerRepository, $quoteRepository, $extensibleDataObjectConverter, $quoteManagement, $dataObjectHelper);
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
    public function getCheckout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCheckout');
        if (!$pluginInfo) {
            return parent::getCheckout();
        } else {
            return $this->___callPlugins('getCheckout', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getQuote()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getQuote');
        if (!$pluginInfo) {
            return parent::getQuote();
        } else {
            return $this->___callPlugins('getQuote', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setQuote(\Magento\Quote\Model\Quote $quote)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setQuote');
        if (!$pluginInfo) {
            return parent::setQuote($quote);
        } else {
            return $this->___callPlugins('setQuote', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerSession()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomerSession');
        if (!$pluginInfo) {
            return parent::getCustomerSession();
        } else {
            return $this->___callPlugins('getCustomerSession', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function initCheckout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'initCheckout');
        if (!$pluginInfo) {
            return parent::initCheckout();
        } else {
            return $this->___callPlugins('initCheckout', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCheckoutMethod()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCheckoutMethod');
        if (!$pluginInfo) {
            return parent::getCheckoutMethod();
        } else {
            return $this->___callPlugins('getCheckoutMethod', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveCheckoutMethod($method)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveCheckoutMethod');
        if (!$pluginInfo) {
            return parent::saveCheckoutMethod($method);
        } else {
            return $this->___callPlugins('saveCheckoutMethod', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveBilling($data, $customerAddressId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveBilling');
        if (!$pluginInfo) {
            return parent::saveBilling($data, $customerAddressId);
        } else {
            return $this->___callPlugins('saveBilling', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveShipping($data, $customerAddressId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveShipping');
        if (!$pluginInfo) {
            return parent::saveShipping($data, $customerAddressId);
        } else {
            return $this->___callPlugins('saveShipping', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveShippingMethod($shippingMethod)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveShippingMethod');
        if (!$pluginInfo) {
            return parent::saveShippingMethod($shippingMethod);
        } else {
            return $this->___callPlugins('saveShippingMethod', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function savePayment($data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'savePayment');
        if (!$pluginInfo) {
            return parent::savePayment($data);
        } else {
            return $this->___callPlugins('savePayment', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function saveOrder()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'saveOrder');
        if (!$pluginInfo) {
            return parent::saveOrder();
        } else {
            return $this->___callPlugins('saveOrder', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLastOrderId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLastOrderId');
        if (!$pluginInfo) {
            return parent::getLastOrderId();
        } else {
            return $this->___callPlugins('getLastOrderId', func_get_args(), $pluginInfo);
        }
    }
}
