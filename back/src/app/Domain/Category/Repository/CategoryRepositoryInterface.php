<?php

namespace App\Domain\Category\Repository;

use App\Domain\Category\Model\Entity\ParentCategory;
use App\Domain\Category\Model\Entity\DefaultParentCategory;
use App\Domain\Category\Model\Entity\DefaultChildCategory;
use App\Domain\Category\Model\Value\TransactionType;

interface CategoryRepositoryInterface
{
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