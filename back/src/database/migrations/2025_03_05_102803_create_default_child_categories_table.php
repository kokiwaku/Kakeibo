<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultChildCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_child_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('default_parent_category_id')->constrained()->onDelete('cascade');
            $table->string('category_name');
            $table->foreignId('transaction_type_id')->constrained()->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->unique(['category_name', 'default_parent_category_id'], 'category_name_parent_category_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
        Schema::dropIfExists('default_child_categories');
    }
}
