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
    public function findBy(int $userId, TransactionType $transactionType): array
    {
        // 親カテゴリを取得
        $parentCategories = DB::table('parent_categories')
            ->join('transaction_types', 'parent_categories.transaction_type_id', '=', 'transaction_types.id')
            ->where('parent_categories.user_id', $userId)
            ->where('transaction_types.slug', $transactionType->toString())
            ->select('parent_categories.*')
            ->get();

        if ($parentCategories->isEmpty()) {
            return [];
        }

        // 親カテゴリIDの配列を取得
        $parentCategoryIds = $parentCategories->pluck('id')->toArray();

        // 子カテゴリを取得
        $childCategories = DB::table('child_categories')
            ->join('transaction_types', 'child_categories.transaction_type_id', '=', 'transaction_types.id')
            ->where('child_categories.user_id', $userId)
            ->where('transaction_types.slug', $transactionType->toString())
            ->whereIn('child_categories.parent_category_id', $parentCategoryIds)
            ->select('child_categories.*')
            ->get()
            ->groupBy('parent_category_id');

        // 親カテゴリと子カテゴリを組み合わせ
        return $parentCategories->map(function ($parentCategory) use ($childCategories) {
            $children = $childCategories->get($parentCategory->id, collect())->map(function ($child) {
                return new ChildCategory(
                    id: $child->id,
                    name: $child->category_name,
                    parentCategoryId: $child->parent_category_id,
                );
            })->toArray();

            return new ParentCategory(
                id: $parentCategory->id,
                name: $parentCategory->category_name,
                children: $children,
            );
        })->toArray();
    }

    public function createParentCategory(int $userId, TransactionType $transactionType, string $categoryName): ParentCategory
    {
        $transactionTypeId = DB::table('transaction_types')
            ->where('slug', $transactionType->toString())
            ->value('id');

        $newParentId = DB::table('parent_categories')->insertGetId([
            'user_id' => $userId,
            'category_name' => $categoryName,
            'transaction_type_id' => $transactionTypeId,
            'is_default_category' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return new ParentCategory(
            id: $newParentId,
            name: $categoryName,
            children: [],
        );
    }

    public function createChildCategory(int $userId, TransactionType $transactionType, string $categoryName, int $parentCategoryId): int
    {
        $transactionTypeId = DB::table('transaction_types')
            ->where('slug', $transactionType->toString())
            ->value('id');

        return DB::table('child_categories')->insertGetId([
            'user_id' => $userId,
            'category_name' => $categoryName,
            'transaction_type_id' => $transactionTypeId,
            'parent_category_id' => $parentCategoryId,
            'is_default_category' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function findById(int $categoryId, int $userId): ?ParentCategory
    {
        $parentCategory = DB::table('parent_categories')
            ->where('id', $categoryId)
            ->where('user_id', $userId)
            ->first();

        if (!$parentCategory) {
            return null;
        }

        return new ParentCategory(
            id: $parentCategory->id,
            name: $parentCategory->category_name,
            children: [],
        );
    }

    public function updateCategoryName(int $categoryId, string $categoryName, int $userId): ParentCategory
    {
        DB::table('parent_categories')
            ->where('id', $categoryId)
            ->where('user_id', $userId)
            ->update([
                'category_name' => $categoryName,
                'updated_at' => now(),
            ]);

        return new ParentCategory(
            id: $categoryId,
            name: $categoryName,
            children: [],
        );
    }

    public function deleteCategory(int $categoryId, int $userId): void
    {
        DB::table('parent_categories')
            ->where('id', $categoryId)
            ->where('user_id', $userId)
            ->delete();
    }

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