<?php

namespace App\Infrastructure\Category\Repository;

use App\Domain\Category\Model\Entity\ParentCategory;
use App\Domain\Category\Model\Entity\ChildCategory;
use App\Domain\Category\Model\Value\TransactionType;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Domain\Category\Model\Entity\DefaultParentCategory;
use App\Domain\Category\Model\Entity\DefaultChildCategory;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function createParentCategoryFromDefault(int $userId, DefaultParentCategory $defaultParent): ParentCategory
    {
        $newParentId = DB::table('parent_categories')->insertGetId([
            'user_id' => $userId,
            'category_name' => $defaultParent->categoryName,
            'transaction_type_id' => $defaultParent->transactionTypeId,
            'is_default_category' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return new ParentCategory(
            id: $newParentId,
            name: $defaultParent->categoryName,
            children: []
        );
    }

    public function createChildCategoryFromDefault(int $userId, DefaultChildCategory $defaultChild, ParentCategory $newParent): int
    {
        return DB::table('child_categories')->insertGetId([
            'user_id' => $userId,
            'category_name' => $defaultChild->categoryName,
            'transaction_type_id' => $defaultChild->transactionTypeId,
            'parent_category_id' => $newParent->id,
            'is_default_category' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}