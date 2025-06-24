<?php

namespace App\UseCase\Category;

use App\Domain\Category\Repository\CategoryRepositoryInterface;

class CreateParentCategoryUseCase
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function handle(CreateParentCategoryRequest $request): CreateParentCategoryResponse
    {
        $parentCategory = $this->categoryRepository->createParentCategory(
            userId: $request->userId,
            transactionType: $request->transactionType,
            categoryName: $request->categoryName,
        );

        return new CreateParentCategoryResponse(
            categoryId: $parentCategory->id,
        );
    }
}