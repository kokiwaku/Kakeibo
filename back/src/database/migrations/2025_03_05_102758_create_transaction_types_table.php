<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // '収入' or '支出'
            $table->string('slug')->unique(); // 'income' or 'expense' (システム内部での使用)
            $table->timestamps();
        });

        // 初期データを挿入
        DB::table('transaction_types')->insert([
            [
                'name' => '収入',
                'slug' => 'income',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '支出',
                'slug' => 'expense',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_types');
    }
}
