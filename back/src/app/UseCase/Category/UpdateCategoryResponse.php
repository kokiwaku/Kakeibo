<?php

namespace App\UseCase\Category;

class UpdateCategoryResponse
{
    public function __construct(
        public readonly int $categoryId,
        public readonly string $categoryName,
    ) {
    }
}