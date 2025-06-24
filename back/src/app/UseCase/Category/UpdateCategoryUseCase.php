<?php

namespace App\UseCase\Category;

use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Category\Exception\CategoryNotFoundException;

class UpdateCategoryUseCase
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function handle(UpdateCategoryRequest $request): UpdateCategoryResponse
    {
        // カテゴリの存在確認とユーザー権限チェック
        $category = $this->categoryRepository->findById($request->categoryId, $request->userId);

        if (!$category) {
            throw new CategoryNotFoundException('Category not found or access denied.');
        }

        // カテゴリ名を更新
        $updatedCategory = $this->categoryRepository->updateCategoryName(
            categoryId: $request->categoryId,
            categoryName: $request->categoryName,
            userId: $request->userId
        );

        return new UpdateCategoryResponse(
            categoryId: $updatedCategory->id,
            categoryName: $updatedCategory->name,
        );
    }
}