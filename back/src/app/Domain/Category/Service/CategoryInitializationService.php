<?php

namespace App\Domain\Category\Service;

use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Category\Repository\DefaultCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryInitializationService
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private DefaultCategoryRepositoryInterface $defaultCategoryRepository
    ) {}

    /**
     * Initialize default categories for a new user
     */
    public function initializeDefaultCategories(int $userId): void
    {
        DB::transaction(function () use ($userId) {
            // デフォルト親カテゴリを取得
            $defaultParentCategories = $this->defaultCategoryRepository->getDefaultParentCategories();
            // 親カテゴリのマッピング（デフォルトID => 新規作成エンティティ）
            $parentCategoryMapping = [];
            foreach ($defaultParentCategories as $defaultParent) {
                // 親カテゴリを作成
                $newParent = $this->categoryRepository->createParentCategoryFromDefault($userId, $defaultParent);
                $parentCategoryMapping[$defaultParent->id] = $newParent;
            }

            // デフォルト子カテゴリを取得
            $defaultChildCategories = $this->defaultCategoryRepository->getDefaultChildCategories();
            foreach ($defaultChildCategories as $defaultChild) {
                // 親カテゴリを取得
                $newParent = $parentCategoryMapping[$defaultChild->defaultParentCategoryId];
                // 子カテゴリを作成
                $this->categoryRepository->createChildCategoryFromDefault($userId, $defaultChild, $newParent);
            }
        });
    }
}