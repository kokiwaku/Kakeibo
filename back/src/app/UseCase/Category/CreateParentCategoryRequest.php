<?php

namespace App\UseCase\Category;

use App\Domain\Category\Model\Value\TransactionType;

class CreateParentCategoryRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly TransactionType $transactionType,
        public readonly string $categoryName,
    ) {
    }
}