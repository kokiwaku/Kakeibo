<?php

namespace App\Domain\Category\Model\Entity;

class ParentCategory
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        /** @var ChildCategory[] */
        public readonly array $children = [],
    ) {
    }
}