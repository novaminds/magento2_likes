<?php
namespace NovaMinds\Likes\Block\Product;


class Like extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    protected $customerSession;
    protected $likeCollection;
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        \NovaMinds\Likes\Model\ResourceModel\Like\CollectionFactory $collectionFactory,
        array $data = []
    )
    { 
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->customerSession = $sessionFactory->create();
        $this->likeCollection = $collectionFactory->create();
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product')->getId();
    }
    
    public function getThisCustomer()
    {
        return $this->customerSession;
    }
    
    public function getLikeCollection()
    {
        return $this->likeCollection;
    }
    
}