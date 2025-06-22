<?php

namespace App\UseCase\Category;

class CreateParentCategoryResponse
{
    public function __construct(
        public readonly int $categoryId,
    ) {
    }
}