<?php

namespace App\UseCase\Category;

use App\Domain\Category\Repository\CategoryRepositoryInterface;

class CreateChildCategoryUseCase
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function handle(CreateChildCategoryRequest $request): CreateChildCategoryResponse
    {
        $categoryId = $this->categoryRepository->createChildCategory(
            userId: $request->userId,
            transactionType: $request->transactionType,
            categoryName: $request->categoryName,
            parentCategoryId: $request->parentCategoryId,
        );

        return new CreateChildCategoryResponse(
            categoryId: $categoryId,
        );
    }
}