<?php

namespace App\Domain\Category\Repository;

use App\Domain\Category\Model\Entity\ParentCategory;
use App\Domain\Category\Model\Entity\DefaultParentCategory;
use App\Domain\Category\Model\Entity\DefaultChildCategory;
use App\Domain\Category\Model\Value\TransactionType;

interface CategoryRepositoryInterface
{
    /**
     * Find categories by user ID and transaction type
     * @param int $userId
     * @param TransactionType $transactionType
     * @return ParentCategory[]
     */
    public function findBy(int $userId, TransactionType $transactionType): array;

    /**
     * Create a parent category
     * @param int $userId
     * @param TransactionType $transactionType
     * @param string $categoryName
     * @return ParentCategory
     */
    public function createParentCategory(int $userId, TransactionType $transactionType, string $categoryName): ParentCategory;

    /**
     * Create a child category
     * @param int $userId
     * @param TransactionType $transactionType
     * @param string $categoryName
     * @param int $parentCategoryId
     * @return int
     */
    public function createChildCategory(int $userId, TransactionType $transactionType, string $categoryName, int $parentCategoryId): int;

    /**
     * Find category by ID and user ID
     * @param int $categoryId
     * @param int $userId
     * @return ParentCategory|null
     */
    public function findById(int $categoryId, int $userId): ?ParentCategory;

    /**
     * Update category name
     * @param int $categoryId
     * @param string $categoryName
     * @param int $userId
     * @return ParentCategory
     */
    public function updateCategoryName(int $categoryId, string $categoryName, int $userId): ParentCategory;

    /**
     * Delete category
     * @param int $categoryId
     * @param int $userId
     * @return void
     */
    public function deleteCategory(int $categoryId, int $userId): void;

    /**
     * Create a parent category from default category entity
     * @param int $userId
     * @param DefaultParentCategory $defaultParent
     * @return ParentCategory
     */
    public function createParentCategoryFromDefault(int $userId, DefaultParentCategory $defaultParent): ParentCategory;

    /**
     * Create a child category from default category entity
     * @param int $userId
     * @param DefaultChildCategory $defaultChild
     * @param ParentCategory $newParent
     * @return int
     */
    public function createChildCategoryFromDefault(int $userId, DefaultChildCategory $defaultChild, ParentCategory $newParent): int;
}