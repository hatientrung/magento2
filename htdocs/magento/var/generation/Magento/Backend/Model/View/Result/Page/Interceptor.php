<?php
namespace Magento\Backend\Model\View\Result\Page;

/**
 * Interceptor class for @see \Magento\Backend\Model\View\Result\Page
 */
class Interceptor extends \Magento\Backend\Model\View\Result\Page
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

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\View\LayoutFactory $layoutFactory, \Magento\Framework\View\Layout\ReaderPool $layoutReaderPool, \Magento\Framework\Translate\InlineInterface $translateInline, \Magento\Framework\View\Layout\BuilderFactory $layoutBuilderFactory, \Magento\Framework\View\Layout\GeneratorPool $generatorPool, \Magento\Framework\View\Page\Config\RendererFactory $pageConfigRendererFactory, \Magento\Framework\View\Page\Layout\Reader $pageLayoutReader, $template)
    {
        $this->___init();
        parent::__construct($context, $layoutFactory, $layoutReaderPool, $translateInline, $layoutBuilderFactory, $generatorPool, $pageConfigRendererFactory, $pageLayoutReader, $template);
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
    public function setActiveMenu($itemId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setActiveMenu');
        if (!$pluginInfo) {
            return parent::setActiveMenu($itemId);
        } else {
            return $this->___callPlugins('setActiveMenu', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addBreadcrumb($label, $title, $link = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addBreadcrumb');
        if (!$pluginInfo) {
            return parent::addBreadcrumb($label, $title, $link);
        } else {
            return $this->___callPlugins('addBreadcrumb', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addContent(\Magento\Framework\View\Element\AbstractBlock $block)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addContent');
        if (!$pluginInfo) {
            return parent::addContent($block);
        } else {
            return $this->___callPlugins('addContent', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addLeft(\Magento\Framework\View\Element\AbstractBlock $block)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addLeft');
        if (!$pluginInfo) {
            return parent::addLeft($block);
        } else {
            return $this->___callPlugins('addLeft', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addJs(\Magento\Framework\View\Element\AbstractBlock $block)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addJs');
        if (!$pluginInfo) {
            return parent::addJs($block);
        } else {
            return $this->___callPlugins('addJs', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function initLayout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'initLayout');
        if (!$pluginInfo) {
            return parent::initLayout();
        } else {
            return $this->___callPlugins('initLayout', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addDefaultHandle()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addDefaultHandle');
        if (!$pluginInfo) {
            return parent::addDefaultHandle();
        } else {
            return $this->___callPlugins('addDefaultHandle', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getConfig');
        if (!$pluginInfo) {
            return parent::getConfig();
        } else {
            return $this->___callPlugins('getConfig', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addPageLayoutHandles(array $parameters = array(), $defaultHandle = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addPageLayoutHandles');
        if (!$pluginInfo) {
            return parent::addPageLayoutHandles($parameters, $defaultHandle);
        } else {
            return $this->___callPlugins('addPageLayoutHandles', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLayout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLayout');
        if (!$pluginInfo) {
            return parent::getLayout();
        } else {
            return $this->___callPlugins('getLayout', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLayoutHandle()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultLayoutHandle');
        if (!$pluginInfo) {
            return parent::getDefaultLayoutHandle();
        } else {
            return $this->___callPlugins('getDefaultLayoutHandle', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addHandle($handleName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addHandle');
        if (!$pluginInfo) {
            return parent::addHandle($handleName);
        } else {
            return $this->___callPlugins('addHandle', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addUpdate($update)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addUpdate');
        if (!$pluginInfo) {
            return parent::addUpdate($update);
        } else {
            return $this->___callPlugins('addUpdate', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderResult(\Magento\Framework\App\ResponseInterface $response)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'renderResult');
        if (!$pluginInfo) {
            return parent::renderResult($response);
        } else {
            return $this->___callPlugins('renderResult', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpResponseCode($httpCode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setHttpResponseCode');
        if (!$pluginInfo) {
            return parent::setHttpResponseCode($httpCode);
        } else {
            return $this->___callPlugins('setHttpResponseCode', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setHeader($name, $value, $replace = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setHeader');
        if (!$pluginInfo) {
            return parent::setHeader($name, $value, $replace);
        } else {
            return $this->___callPlugins('setHeader', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusHeader($httpCode, $version = null, $phrase = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setStatusHeader');
        if (!$pluginInfo) {
            return parent::setStatusHeader($httpCode, $version, $phrase);
        } else {
            return $this->___callPlugins('setStatusHeader', func_get_args(), $pluginInfo);
        }
    }
}
