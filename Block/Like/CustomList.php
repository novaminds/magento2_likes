<?php

namespace NovaMinds\Likes\Block\Like;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;

class CustomList extends ListProduct
{
    
    
    
    public function getLoadedProductCollection()
    {
        return $this->_productCollection;
    }

   public function setProCollection(AbstractCollection $collection)
    {
        $this->_productCollection = $collection;
    }
    
    
}


