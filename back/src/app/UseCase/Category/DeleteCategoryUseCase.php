<?php

namespace App\UseCase\Category;

use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Category\Exception\CategoryNotFoundException;

class DeleteCategoryUseCase
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function handle(DeleteCategoryRequest $request): DeleteCategoryResponse
    {
        // カテゴリの存在確認とユーザー権限チェック
        $category = $this->categoryRepository->findById($request->categoryId, $request->userId);

        if (!$category) {
            throw new CategoryNotFoundException('Category not found or access denied.');
        }

        // カテゴリを削除
        $this->categoryRepository->deleteCategory(
            categoryId: $request->categoryId,
            userId: $request->userId
        );

        return new DeleteCategoryResponse(
            categoryId: $request->categoryId,
        );
    }
}