<?php
namespace NovaMinds\Likes\Block\Like;
class Likeslist extends \Magento\Framework\View\Element\Template
{
    public function getLikedProducts(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        $customerId = $customerSession->getCustomer()->getId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $collection = $objectManager->get('NovaMinds\Likes\Model\Like')->getCollection();
        $likedProducts = $collection->addFieldToSelect('*')->addFieldToFilter('customer_id' , $customerId)
                                                  ->addFieldToFilter('status' , 'like');
        return $likedProducts;
    }
}