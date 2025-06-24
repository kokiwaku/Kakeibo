<?php

namespace App\Infrastructure\Category\Repository;

use App\Domain\Category\Repository\DefaultCategoryRepositoryInterface;
use App\Domain\Category\Model\Entity\DefaultParentCategory;
use App\Domain\Category\Model\Entity\DefaultChildCategory;
use Illuminate\Support\Facades\DB;

class DefaultCategoryRepository implements DefaultCategoryRepositoryInterface
{
    public function getDefaultParentCategories(): array
    {
        $records = DB::table('default_parent_categories')
            ->select('id', 'category_name', 'transaction_type_id', 'display_order')
            ->orderBy('display_order')
            ->get()
            ->toArray();

        return array_map(
            fn (object $record) => DefaultParentCategory::fromArray((array) $record),
            $records
        );
    }

    public function getDefaultChildCategories(): array
    {
        $records = DB::table('default_child_categories')
            ->select('id', 'category_name', 'transaction_type_id', 'default_parent_category_id', 'display_order')
            ->orderBy('default_parent_category_id')
            ->orderBy('display_order')
            ->get()
            ->toArray();

        return array_map(
            fn (object $record) => DefaultChildCategory::fromArray((array) $record),
            $records
        );
    }
}