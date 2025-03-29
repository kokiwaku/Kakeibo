<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // デフォルトカテゴリの作成
        $this->call([
            DefaultIncomeCategorySeeder::class,
            DefaultExpenseCategorySeeder::class,
        ]);
    }
}
