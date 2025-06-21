<?php

namespace App\Domain\Category\Repository;

use App\Domain\Category\Model\Entity\DefaultParentCategory;
use App\Domain\Category\Model\Entity\DefaultChildCategory;

interface DefaultCategoryRepositoryInterface
{
    /**
     * Get all default parent categories
     * @return DefaultParentCategory[]
     */
    public function getDefaultParentCategories(): array;

    /**
     * Get all default child categories
     * @return DefaultChildCategory[]
     */
    public function getDefaultChildCategories(): array;
}