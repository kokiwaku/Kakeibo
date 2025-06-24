<?php

namespace App\Domain\Category\Model\Entity;

class ChildCategory
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $parentCategoryId,
        public readonly int $displayOrder,
    ) {
    }
}
