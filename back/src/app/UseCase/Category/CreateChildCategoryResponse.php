<?php

namespace App\UseCase\Category;

class CreateChildCategoryResponse
{
    public function __construct(
        public readonly int $categoryId,
    ) {
    }
}