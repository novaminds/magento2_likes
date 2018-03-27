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

namespace NovaMinds\Likes\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LikeRepositoryInterface
{


    /**
     * Save like
     * @param \NovaMinds\Likes\Api\Data\LikeInterface $like
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \NovaMinds\Likes\Api\Data\LikeInterface $like
    );

    /**
     * Retrieve like
     * @param string $likeId
     * @return \NovaMinds\Likes\Api\Data\LikeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($likeId);

    /**
     * Retrieve like matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \NovaMinds\Likes\Api\Data\LikeSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete like
     * @param \NovaMinds\Likes\Api\Data\LikeInterface $like
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \NovaMinds\Likes\Api\Data\LikeInterface $like
    );

    /**
     * Delete like by ID
     * @param string $likeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($likeId);
}
