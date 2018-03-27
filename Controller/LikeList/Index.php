<?php
namespace NovaMinds\Likes\Controller\LikeList;
  
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    
    protected $pageFactory;
    protected $customerSession;
    protected $productCollection;
    protected $likeCollectionFactory;
    
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \NovaMinds\Likes\Model\ResourceModel\Like\CollectionFactory $likeCollectionFactory
    )
    {  
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->productCollection = $collectionFactory->create();
        $this->customerSession = $customerSession;
        $this->likeCollectionFactory = $likeCollectionFactory;
    }

    public function execute()
    {
        
        $result = $this->pageFactory->create();

        $customerId = $this->customerSession->getCustomer()->getId();
        $likeCollection = $this->likeCollectionFactory->create();
        $likedProductsIds = $likeCollection->addFieldToSelect('product_id')->addFieldToFilter('customer_id' , $customerId)
                                                  ->addFieldToFilter('status' , 'like');

        
        $ProductIds = []; 
        
        foreach ($likedProductsIds as $pId){
            array_push($ProductIds, $pId->getProductId());
        }
        
        $this->productCollection->addIdFilter($ProductIds); 
        $this->productCollection->addFieldToSelect('*');
        $list = $result->getLayout()->getBlock('custom.products.list');
        $list->setProCollection($this->productCollection);

        return $result;
        
    }
    
    
    
    

}
