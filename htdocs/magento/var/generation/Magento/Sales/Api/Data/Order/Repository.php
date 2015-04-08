<?php
namespace Magento\Sales\Api\Data\Order;

/**
 * Repository class for @see \Magento\Sales\Api\Data\OrderInterface
 */
class Repository implements \Magento\Sales\Api\OrderRepositoryInterface
{
    /**
     * orderInterfacePersistor
     *
     * @var \Magento\Sales\Api\Data\OrderInterfacePersistor
     */
    protected $orderInterfacePersistor = null;

    /**
     * Collection Factory
     *
     * @var \Magento\Sales\Api\Data\OrderSearchResultInterfaceFactory
     */
    protected $orderInterfaceSearchResultFactory = null;

    /**
     * \Magento\Sales\Api\Data\OrderInterface[]
     *
     * @var array
     */
    protected $registry = array(
        
    );

    /**
     * Repository constructor
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $orderInterfacePersistor
     * @param \Magento\Sales\Api\Data\OrderSearchResultInterfaceFactory
     * $orderInterfaceSearchResultFactory
     */
    public function __construct(\Magento\Sales\Api\Data\OrderInterfacePersistor $orderInterfacePersistor, \Magento\Sales\Api\Data\OrderSearchResultInterfaceFactory $orderInterfaceSearchResultFactory)
    {
        $this->orderInterfacePersistor = $orderInterfacePersistor;
        $this->orderInterfaceSearchResultFactory = $orderInterfaceSearchResultFactory;
    }

    /**
     * load entity
     *
     * @param int $id
     * @return \Magento\Sales\Api\Data\OrderInterface
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id)
    {
        if (!$id) {
            throw new \Magento\Framework\Exception\InputException('ID required');
        }
        if (!isset($this->registry[$id])) {
            $entity = $this->orderInterfacePersistor->loadEntity($id);
            if (!$entity->getId()) {
                throw new \Magento\Framework\Exception\NoSuchEntityException('Requested entity doesn\'t exist');
            }
            $this->registry[$id] = $entity;
        }
        return $this->registry[$id];
    }

    /**
     * Register entity to create
     *
     * @param array $data
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function create(\Magento\Sales\Api\Data\OrderInterface $entity)
    {
        return $this->orderInterfacePersistor->registerNew($entity);
    }

    /**
     * Register entity to create
     *
     * @param array $data
     * @return \Magento\Sales\Api\Data\Order\Repository
     */
    public function createFromArray(array $data)
    {
        return $this->orderInterfacePersistor->registerFromArray($data);
    }

    /**
     * Find entities by criteria
     *
     * @param \Magento\Framework\Api\SearchCriteria  $criteria
     * @return \Magento\Sales\Api\Data\OrderInterface[]
     */
    public function getList(\Magento\Framework\Api\SearchCriteria $criteria)
    {
        $collection = $this->orderInterfaceSearchResultFactory->create();
        foreach($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        return $collection;
    }

    /**
     * Register entity to delete
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $entity
     */
    public function remove(\Magento\Sales\Api\Data\OrderInterface $entity)
    {
        $this->orderInterfacePersistor->registerDeleted($entity);
    }

    /**
     * Register entity to delete
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $entity
     */
    public function delete(\Magento\Sales\Api\Data\OrderInterface $entity)
    {
        $this->orderInterfacePersistor->registerDeleted($entity);
        return $this->orderInterfacePersistor->doPersistEntity($entity);
    }

    /**
     * Delete entity by Id
     *
     * @param int $id
     */
    public function deleteById($id)
    {
        $entity = $this->get($id);
        $this->orderInterfacePersistor->registerDeleted($entity);
        return $this->orderInterfacePersistor->doPersistEntity($entity);
    }

    /**
     * Perform persist operations
     */
    public function flush()
    {
        $ids = $this->orderInterfacePersistor->doPersist();
        foreach ($ids as $id) {
        unset($this->registry[$id]);
        }
    }

    /**
     * Perform persist operations for one entity
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $entity
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function save(\Magento\Sales\Api\Data\OrderInterface $entity)
    {
        $this->orderInterfacePersistor->doPersistEntity($entity);
        return $entity;
    }
}
