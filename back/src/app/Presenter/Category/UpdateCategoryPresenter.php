<?php

namespace App\Presenter\Category;

class UpdateCategoryPresenter
{
    /**
     * 更新されたカテゴリをレスポンス用に変換
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
        ];
    }
}