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

interface LikeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get like list.
     * @return \NovaMinds\Likes\Api\Data\LikeInterface[]
     */
    public function getItems();

    /**
     * Set cuatomer_id list.
     * @param \NovaMinds\Likes\Api\Data\LikeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
