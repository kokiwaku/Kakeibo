<?php

namespace App\UseCase\Category;

use App\Domain\Category\Model\Value\TransactionType;

class GetCategoryListRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly TransactionType $transactionType,
    ) {
    }
}
