<?php

namespace App\UseCase\Category;

class UpdateCategoryRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly int $categoryId,
        public readonly string $categoryName,
    ) {
    }
}