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
        // 親カテゴリを取得（display_orderでソート）
        $parentCategories = DB::table('parent_categories')
            ->join('transaction_types', 'parent_categories.transaction_type_id', '=', 'transaction_types.id')
            ->where('parent_categories.user_id', $userId)
            ->where('transaction_types.slug', $transactionType->toString())
            ->select('parent_categories.*')
            ->orderBy('parent_categories.display_order')
            ->get();

        if ($parentCategories->isEmpty()) {
            return [];
        }

        // 親カテゴリIDの配列を取得
        $parentCategoryIds = $parentCategories->pluck('id')->toArray();

        // 子カテゴリを取得（display_orderでソート）
        $childCategories = DB::table('child_categories')
            ->join('transaction_types', 'child_categories.transaction_type_id', '=', 'transaction_types.id')
            ->where('child_categories.user_id', $userId)
            ->where('transaction_types.slug', $transactionType->toString())
            ->whereIn('child_categories.parent_category_id', $parentCategoryIds)
            ->select('child_categories.*')
            ->orderBy('child_categories.parent_category_id')
            ->orderBy('child_categories.display_order')
            ->get()
            ->groupBy('parent_category_id');

        // 親カテゴリと子カテゴリを組み合わせ
        return $parentCategories->map(function ($parentCategory) use ($childCategories) {
            $children = $childCategories->get($parentCategory->id, collect())->map(function ($child) {
                return new ChildCategory(
                    id: $child->id,
                    name: $child->category_name,
                    parentCategoryId: $child->parent_category_id,
                    displayOrder: $child->display_order,
                );
            })->toArray();

            return new ParentCategory(
                id: $parentCategory->id,
                name: $parentCategory->category_name,
                children: $children,
                displayOrder: $parentCategory->display_order,
            );
        })->toArray();
    }

    public function createParentCategory(int $userId, TransactionType $transactionType, string $categoryName): ParentCategory
    {
        $transactionTypeId = DB::table('transaction_types')
            ->where('slug', $transactionType->toString())
            ->value('id');

        // 未分類を除く最大のdisplay_orderを取得して+1
        $maxDisplayOrder = DB::table('parent_categories')
            ->where('user_id', $userId)
            ->where('transaction_type_id', $transactionTypeId)
            ->where('display_order', '<', 99) // 未分類（display_order = 99）を除外
            ->max('display_order') ?? 0;

        $newParentId = DB::table('parent_categories')->insertGetId([
            'user_id' => $userId,
            'category_name' => $categoryName,
            'transaction_type_id' => $transactionTypeId,
            'is_default_category' => false,
            'display_order' => $maxDisplayOrder + 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return new ParentCategory(
            id: $newParentId,
            name: $categoryName,
            children: [],
            displayOrder: $maxDisplayOrder + 1,
        );
    }

    public function createChildCategory(int $userId, TransactionType $transactionType, string $categoryName, int $parentCategoryId): int
    {
        $transactionTypeId = DB::table('transaction_types')
            ->where('slug', $transactionType->toString())
            ->value('id');

        // 親カテゴリ内での最大のdisplay_orderを取得して+1
        $maxDisplayOrder = DB::table('child_categories')
            ->where('user_id', $userId)
            ->where('parent_category_id', $parentCategoryId)
            ->max('display_order') ?? 0;

        return DB::table('child_categories')->insertGetId([
            'user_id' => $userId,
            'category_name' => $categoryName,
            'transaction_type_id' => $transactionTypeId,
            'parent_category_id' => $parentCategoryId,
            'is_default_category' => false,
            'display_order' => $maxDisplayOrder + 1,
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
            displayOrder: $parentCategory->display_order,
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

        $parentCategory = DB::table('parent_categories')
            ->where('id', $categoryId)
            ->where('user_id', $userId)
            ->first();

        return new ParentCategory(
            id: $categoryId,
            name: $categoryName,
            children: [],
            displayOrder: $parentCategory->display_order,
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
            'display_order' => $defaultParent->displayOrder,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return new ParentCategory(
            id: $newParentId,
            name: $defaultParent->categoryName,
            children: [],
            displayOrder: $defaultParent->displayOrder,
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
            'display_order' => $defaultChild->displayOrder,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}