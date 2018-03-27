<?php
namespace NovaMinds\Likes\Controller\Like;

use \Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action

{

    public function execute()
    {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        
        $productId = $this->getRequest()->getParam('productId');
        
        $product = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
        
        $customerId = $customerSession->getCustomer()->getId();
        
        $like = $this->_objectManager->create('NovaMinds\Likes\Model\Like');
        
        $likeId = $this->getRequest()->getParam('likeId');
        
        
        if($likeId == null){
            $like->setCustomerId($customerId);
            $like->setProductId($productId);
            $like->setStatus('like');
        }else{
            $like->load($likeId);
            ($like->getStatus() == 'like')? $like->setStatus('unlike') : $like->setStatus('like');
        }
       
       
//        
        try {

            $like->save();
            
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the liked product'));
        }
        
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData(['message' => ($like->getStatus() == 'like')? 'unlike' : 'like']);
        return $resultJson;

    }
    
}

