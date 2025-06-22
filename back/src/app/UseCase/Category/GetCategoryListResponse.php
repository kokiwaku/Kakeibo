<?php

namespace App\UseCase\Category;

use App\Domain\Category\Model\Entity\ParentCategory;

class GetCategoryListResponse
{
    /**
     * @param ParentCategory[] $parentCategories
     */
    public function __construct(
        public readonly array $parentCategories,
    ) {
    }
}