<?php

namespace App\UseCase\Category;

class DeleteCategoryRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly int $categoryId,
    ) {
    }
}