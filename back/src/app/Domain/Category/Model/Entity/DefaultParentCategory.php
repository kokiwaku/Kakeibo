<?php

namespace App\Domain\Category\Model\Entity;

class DefaultParentCategory
{
    public function __construct(
        public readonly int $id,
        public readonly string $categoryName,
        public readonly int $transactionTypeId,
        public readonly int $displayOrder,
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
            displayOrder: $record['display_order'],
        );
    }
}