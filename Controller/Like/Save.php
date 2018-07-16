<?php
namespace NovaMinds\Likes\Controller\Like;

use \Magento\Catalog\Model\ProductRepository;
use \Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action

{
    protected $customerSession;
    protected $product;
    protected $like;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Model\Product $product,
        \NovaMinds\Likes\Model\Like $like
    ){
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->product = $product;
        $this->like = $like;
    }

    public function execute()
    {
        $productId = $this->getRequest()->getParam('productId');        
        $product = $this->product->load($productId);        
        $customerId = $this->customerSession->getCustomer()->getId();
  
        $likeId = $this->getRequest()->getParam('likeId');
        if($likeId == null){
            $this->like->setCustomerId($customerId);
            $this->like->setProductId($productId);
            $this->like->setStatus('like');
        }else{
            $this->like->load($likeId);
            ($this->like->getStatus() == 'like')? $this->like->setStatus('unlike') : $this->like->setStatus('like');
        }
                   
        try {

            $this->like->save();
            
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the liked product'));
        }
        
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData(['message' => ($this->like->getStatus() == 'like')? 'unlike' : 'like']);
        return $resultJson;

    }
    
}

