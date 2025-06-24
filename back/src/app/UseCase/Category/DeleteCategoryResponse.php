<?php

namespace App\UseCase\Category;

class DeleteCategoryResponse
{
    public function __construct(
        public readonly int $categoryId,
    ) {
    }
}