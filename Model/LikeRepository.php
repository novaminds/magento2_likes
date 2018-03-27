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

use NovaMinds\Likes\Model\ResourceModel\Like as ResourceLike;
use Magento\Framework\Api\DataObjectHelper;
use NovaMinds\Likes\Api\Data\LikeSearchResultsInterfaceFactory;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use NovaMinds\Likes\Api\LikeRepositoryInterface;
use NovaMinds\Likes\Api\Data\LikeInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use NovaMinds\Likes\Model\ResourceModel\Like\CollectionFactory as LikeCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class LikeRepository implements likeRepositoryInterface
{

    protected $resource;

    protected $likeFactory;

    protected $dataLikeFactory;

    protected $likeCollectionFactory;

    protected $searchResultsFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;


    /**
     * @param ResourceLike $resource
     * @param LikeFactory $likeFactory
     * @param LikeInterfaceFactory $dataLikeFactory
     * @param LikeCollectionFactory $likeCollectionFactory
     * @param LikeSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceLike $resource,
        LikeFactory $likeFactory,
        LikeInterfaceFactory $dataLikeFactory,
        LikeCollectionFactory $likeCollectionFactory,
        LikeSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->likeFactory = $likeFactory;
        $this->likeCollectionFactory = $likeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLikeFactory = $dataLikeFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \NovaMinds\Likes\Api\Data\LikeInterface $like
    ) {
        /* if (empty($like->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $like->setStoreId($storeId);
        } */
        try {
            $like->getResource()->save($like);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the like: %1',
                $exception->getMessage()
            ));
        }
        return $like;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($likeId)
    {
        $like = $this->likeFactory->create();
        $like->getResource()->load($like, $likeId);
        if (!$like->getId()) {
            throw new NoSuchEntityException(__('like with id "%1" does not exist.', $likeId));
        }
        return $like;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->likeCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \NovaMinds\Likes\Api\Data\LikeInterface $like
    ) {
        try {
            $like->getResource()->delete($like);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the like: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($likeId)
    {
        return $this->delete($this->getById($likeId));
    }
}
