<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultIncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionTypeId = 1;
        // 給与カテゴリ (display_order: 1)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '給与',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $salaryParentId = DB::table('default_parent_categories')
            ->where('category_name', '給与')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '給与',
                    'default_parent_category_id' => $salaryParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '賞与',
                    'default_parent_category_id' => $salaryParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '副業',
                    'default_parent_category_id' => $salaryParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // その他収入カテゴリ (display_order: 2)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => 'その他',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $otherParentId = DB::table('default_parent_categories')
            ->where('category_name', 'その他')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '配当金',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '不動産収入',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '臨時収入',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => 'お小遣い',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );
    }
}
