<?php

namespace App\Presenter\Category;

class CreateParentCategoryPresenter
{
    /**
     * 新規作成されたParentCategoryをレスポンス用に変換
     *
     * @param int $categoryId
     * @param string $categoryName
     * @return array
     */
    public function toResponse(int $categoryId, string $categoryName): array
    {
        return [
            'id' => $categoryId,
            'name' => $categoryName,
            'subCategory' => [],
        ];
    }
}