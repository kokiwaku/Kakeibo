<?php

namespace App\Presenter\Category;

class DeleteCategoryPresenter
{
    /**
     * 削除されたカテゴリをレスポンス用に変換
     *
     * @param int $categoryId
     * @return array
     */
    public function toResponse(int $categoryId): array
    {
        return [
            'id' => $categoryId,
            'message' => 'Category deleted successfully',
        ];
    }
}