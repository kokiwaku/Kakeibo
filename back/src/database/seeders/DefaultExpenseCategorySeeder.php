<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionTypeId = 2;

        // 食費カテゴリ (display_order: 1)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '食費',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $foodParentId = DB::table('default_parent_categories')
            ->where('category_name', '食費')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '食料品',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '外食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => 'カフェ',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => '朝食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => '昼食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ],
                [
                    'category_name' => '夕食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 6,
                ],
                [
                    'category_name' => '夜食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 7,
                ],
                [
                    'category_name' => 'その他食費',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 8,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 日用品カテゴリ (display_order: 2)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '日用品',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $dailyParentId = DB::table('default_parent_categories')
            ->where('category_name', '日用品')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '衣服',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '靴',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => 'アクセサリー',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => '化粧品',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => '生活用品',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ],
                [
                    'category_name' => 'その他日用品',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 6,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 趣味・娯楽カテゴリ (display_order: 3)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '趣味・娯楽',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $hobbyParentId = DB::table('default_parent_categories')
            ->where('category_name', '趣味・娯楽')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => 'アウトドア',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => 'スポーツ',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => 'ゲーム',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => '映画・音楽',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => '本',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ],
                [
                    'category_name' => '旅行',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 6,
                ],
                [
                    'category_name' => 'その他趣味',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 7,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 交通費カテゴリ (display_order: 4)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '交通費',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $transportParentId = DB::table('default_parent_categories')
            ->where('category_name', '交通費')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '電車',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => 'バス',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => 'タクシー',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => '飛行機',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => 'その他交通費',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 健康・医療カテゴリ (display_order: 5)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '健康・医療',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $healthParentId = DB::table('default_parent_categories')
            ->where('category_name', '健康・医療')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '病院',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '薬',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '歯科',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => '眼科',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => 'その他医療費',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 教育・教養カテゴリ (display_order: 6)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '教育・教養',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 6,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $educationParentId = DB::table('default_parent_categories')
            ->where('category_name', '教育・教養')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '書籍',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '新聞・雑誌',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '習い事',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => 'セミナー',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => '学費',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ],
                [
                    'category_name' => 'その他教育費',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 6,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 特別な支出カテゴリ (display_order: 7)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '特別な支出',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 7,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $specialParentId = DB::table('default_parent_categories')
            ->where('category_name', '特別な支出')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '冠婚葬祭',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '誕生日',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '記念日',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => 'プレゼント',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => 'その他特別費',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 現金・カードカテゴリ (display_order: 8)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '現金・カード',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 8,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $cashParentId = DB::table('default_parent_categories')
            ->where('category_name', '現金・カード')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '現金引き出し',
                    'default_parent_category_id' => $cashParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => 'カード手数料',
                    'default_parent_category_id' => $cashParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => 'その他手数料',
                    'default_parent_category_id' => $cashParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 住宅カテゴリ (display_order: 9)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '住宅',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 9,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $housingParentId = DB::table('default_parent_categories')
            ->where('category_name', '住宅')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '家賃',
                    'default_parent_category_id' => $housingParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '地震・火災保険',
                    'default_parent_category_id' => $housingParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '修繕・メンテナンス',
                    'default_parent_category_id' => $housingParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => 'その他住宅費',
                    'default_parent_category_id' => $housingParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 水道・光熱費カテゴリ (display_order: 10)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '水道・光熱費',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 10,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $utilityParentId = DB::table('default_parent_categories')
            ->where('category_name', '水道・光熱費')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '電気代',
                    'default_parent_category_id' => $utilityParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => 'ガス代',
                    'default_parent_category_id' => $utilityParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '水道代',
                    'default_parent_category_id' => $utilityParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => 'その他光熱費',
                    'default_parent_category_id' => $utilityParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 税金・保険カテゴリ (display_order: 11)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '税金・保険',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 11,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );

        $taxParentId = DB::table('default_parent_categories')
            ->where('category_name', '税金・保険')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '所得税',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '住民税',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '年金保険料',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => '健康保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ],
                [
                    'category_name' => '生命保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 5,
                ],
                [
                    'category_name' => '自動車保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 6,
                ],
                [
                    'category_name' => 'その他税・保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 7,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // その他カテゴリ (display_order: 12)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => 'その他',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 12,
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
                    'category_name' => '仕送り',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 1,
                ],
                [
                    'category_name' => '寄付金',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 2,
                ],
                [
                    'category_name' => '雑費',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 3,
                ],
                [
                    'category_name' => 'その他',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 4,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name', 'display_order']
        );

        // 未分類カテゴリ (display_order: 99)
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '未分類',
                    'transaction_type_id' => $transactionTypeId,
                    'display_order' => 99,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name', 'display_order']
        );
    }
}
