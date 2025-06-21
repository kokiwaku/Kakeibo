<?php

namespace App\Domain\Category\Model\Entity;

class DefaultChildCategory
{
    public function __construct(
        public readonly int $id,
        public readonly string $categoryName,
        public readonly int $transactionTypeId,
        public readonly int $defaultParentCategoryId,
    ) {
    }

    /**
     * Create from database record
     */
    public static function fromArray(array $record): self
    {
        return new self(
            id: $record['id'],
            categoryName: $record['category_name'],
            transactionTypeId: $record['transaction_type_id'],
            defaultParentCategoryId: $record['default_parent_category_id'],
        );
    }
}