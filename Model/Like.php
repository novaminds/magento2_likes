<?php
/**
 * adding a custom product like button
 * Copyright (C) 2017  NovaMinds
 * 
 * This file is part of NovaMinds/Likes.
 * 
 * NovaMinds/Likes is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace NovaMinds\Likes\Model;

use NovaMinds\Likes\Api\Data\LikeInterface;

class Like extends \Magento\Framework\Model\AbstractModel implements LikeInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('NovaMinds\Likes\Model\ResourceModel\Like');
    }

    /**
     * Get like_id
     * @return string
     */
    public function getLikeId()
    {
        return $this->getData(self::LIKE_ID);
    }

    /**
     * Set like_id
     * @param string $likeId
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     */
    public function setLikeId($likeId)
    {
        return $this->setData(self::LIKE_ID, $likeId);
    }

    /**
     * Get cuatomer_id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set cuatomer_id
     * @param string $cuatomer_id
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     */
    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    /**
     * Get product_id
     * @return string
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Set product_id
     * @param string $product_id
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     */
    public function setProductId($product_id)
    {
        return $this->setData(self::PRODUCT_ID, $product_id);
    }
}
