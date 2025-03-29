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
        // 食費カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '食費',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => '外食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'カフェ',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '朝食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '昼食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '夕食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '夜食',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他食費',
                    'default_parent_category_id' => $foodParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 日用品カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '日用品',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => '靴',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'アクセサリー',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '化粧品',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '生活用品',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他日用品',
                    'default_parent_category_id' => $dailyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 趣味・娯楽カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '趣味・娯楽',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => 'スポーツ',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'ゲーム',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '映画・音楽',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '本',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '旅行',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他趣味',
                    'default_parent_category_id' => $hobbyParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 交通費カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '交通費',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => 'バス',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'タクシー',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '飛行機',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他交通費',
                    'default_parent_category_id' => $transportParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 健康・医療カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '健康・医療',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
        );

        $healthParentId = DB::table('default_parent_categories')
            ->where('category_name', '健康・医療')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '医療費',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '薬',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '歯科',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'フィットネス',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'ボディケア',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他医療費',
                    'default_parent_category_id' => $healthParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 自動車カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '自動車',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
        );

        $carParentId = DB::table('default_parent_categories')
            ->where('category_name', '自動車')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => 'ガソリン',
                    'default_parent_category_id' => $carParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '駐車場',
                    'default_parent_category_id' => $carParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '車検・整備',
                    'default_parent_category_id' => $carParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '高速料金',
                    'default_parent_category_id' => $carParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他自動車費',
                    'default_parent_category_id' => $carParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 教育・教養カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '教育・教養',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => '新聞・雑誌',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '習い事',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'セミナー',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '学費',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他教育費',
                    'default_parent_category_id' => $educationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 特別な支出カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '特別な支出',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => '誕生日',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '記念日',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'プレゼント',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他特別費',
                    'default_parent_category_id' => $specialParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 現金・カードカテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '現金・カード',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
        );

        $cashParentId = DB::table('default_parent_categories')
            ->where('category_name', '現金・カード')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => 'ATM引き出し',
                    'default_parent_category_id' => $cashParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '電子マネーチャージ',
                    'default_parent_category_id' => $cashParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'カード引き落とし',
                    'default_parent_category_id' => $cashParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他現金・カード',
                    'default_parent_category_id' => $cashParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 通信費カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '通信費',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
        );

        $communicationParentId = DB::table('default_parent_categories')
            ->where('category_name', '通信費')
            ->where('transaction_type_id', $transactionTypeId)
            ->value('id');

        DB::table('default_child_categories')->upsert(
            [
                [
                    'category_name' => '携帯電話',
                    'default_parent_category_id' => $communicationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '固定電話',
                    'default_parent_category_id' => $communicationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'インターネット',
                    'default_parent_category_id' => $communicationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '放送視聴料',
                    'default_parent_category_id' => $communicationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他通信費',
                    'default_parent_category_id' => $communicationParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 住宅カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '住宅',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => '地震・火災保険',
                    'default_parent_category_id' => $housingParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '修繕・メンテナンス',
                    'default_parent_category_id' => $housingParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他住宅費',
                    'default_parent_category_id' => $housingParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 水道・光熱費カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '水道・光熱費',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => 'ガス代',
                    'default_parent_category_id' => $utilityParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '水道代',
                    'default_parent_category_id' => $utilityParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他水道・光熱費',
                    'default_parent_category_id' => $utilityParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 税金・保険カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '税金・保険',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => '住民税',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '年金保険料',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '健康保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '生命保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '自動車保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他税・保険',
                    'default_parent_category_id' => $taxParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // その他カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => 'その他',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
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
                ],
                [
                    'category_name' => '寄付金',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => '雑費',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                ],
                [
                    'category_name' => 'その他',
                    'default_parent_category_id' => $otherParentId,
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'default_parent_category_id'],
            ['category_name']
        );

        // 未分類カテゴリ
        DB::table('default_parent_categories')->upsert(
            [
                [
                    'category_name' => '未分類',
                    'transaction_type_id' => $transactionTypeId,
                ]
            ],
            ['category_name', 'transaction_type_id'],
            ['category_name']
        );
    }
}
