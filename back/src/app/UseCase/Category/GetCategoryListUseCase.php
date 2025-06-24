<?php

namespace App\UseCase\Category;

use App\Domain\Category\Repository\CategoryRepositoryInterface;

class GetCategoryListUseCase
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    public function handle(GetCategoryListRequest $request)
    {
        $parentCategories = $this->categoryRepository->findBy(
            userId: $request->userId,
            transactionType: $request->transactionType,
        );

        return new GetCategoryListResponse(
            parentCategories: $parentCategories,
        );
    }
}