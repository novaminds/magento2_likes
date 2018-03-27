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

namespace NovaMinds\Likes\Api\Data;

interface LikeInterface
{

    const CUSTOMER_ID = 'customer_id';
    const LIKE_ID = 'like_id';
    const PRODUCT_ID = 'product_id';


    /**
     * Get like_id
     * @return string|null
     */
    public function getLikeId();

    /**
     * Set like_id
     * @param string $like_id
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     */
    public function setLikeId($likeId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set cuatomer_id
     * @param string $customer_id
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     */
    public function setCustomerId($customer_id);

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $product_id
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     */
    public function setProductId($product_id);
}
