<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 親カテゴリテーブルにdisplay_orderカラムを追加
        Schema::table('parent_categories', function (Blueprint $table) {
            $table->integer('display_order')->default(0)->after('is_default_category');
            $table->index('display_order', 'idx_parent_categories_display_order');
        });

        // 子カテゴリテーブルにdisplay_orderカラムを追加
        Schema::table('child_categories', function (Blueprint $table) {
            $table->integer('display_order')->default(0)->after('is_default_category');
            $table->index(['parent_category_id', 'display_order'], 'idx_child_categories_parent_display');
        });

        // デフォルト親カテゴリテーブルにdisplay_orderカラムを追加
        Schema::table('default_parent_categories', function (Blueprint $table) {
            $table->integer('display_order')->default(0)->after('transaction_type_id');
            $table->index('display_order', 'idx_default_parent_categories_display');
        });

        // デフォルト子カテゴリテーブルにdisplay_orderカラムを追加
        Schema::table('default_child_categories', function (Blueprint $table) {
            $table->integer('display_order')->default(0)->after('transaction_type_id');
            $table->index(['default_parent_category_id', 'display_order'], 'idx_default_child_parent_display');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parent_categories', function (Blueprint $table) {
            $table->dropIndex('idx_parent_categories_display_order');
            $table->dropColumn('display_order');
        });

        Schema::table('child_categories', function (Blueprint $table) {
            $table->dropIndex('idx_child_categories_parent_display');
            $table->dropColumn('display_order');
        });

        Schema::table('default_parent_categories', function (Blueprint $table) {
            $table->dropIndex('idx_default_parent_categories_display');
            $table->dropColumn('display_order');
        });

        Schema::table('default_child_categories', function (Blueprint $table) {
            $table->dropIndex('idx_default_child_parent_display');
            $table->dropColumn('display_order');
        });
    }
};