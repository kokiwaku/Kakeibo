<?php

namespace App\UseCase\Category;

use App\Domain\Category\Model\Value\TransactionType;

class CreateChildCategoryRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly TransactionType $transactionType,
        public readonly string $categoryName,
        public readonly int $parentCategoryId,
    ) {
    }
}