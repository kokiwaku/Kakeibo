<?php

namespace App\Presenter\Category;

use App\Domain\Category\Model\Entity\ParentCategory;

class CategoryListPresenter
{
    /**
     * ParentCategoryエンティティの配列をフロントエンド用の配列形式に変換
     *
     * @param ParentCategory[] $parentCategories
     * @return array
     */
    public function toResponse(array $parentCategories): array
    {
        return array_map(function ($parentCategory) {
            return [
                'id' => $parentCategory->id,
                'name' => $parentCategory->name,
                'subCategory' => array_map(function ($child) {
                    return [
                        'id' => $child->id,
                        'name' => $child->name,
                    ];
                }, $parentCategory->children),
            ];
        }, $parentCategories);
    }
}