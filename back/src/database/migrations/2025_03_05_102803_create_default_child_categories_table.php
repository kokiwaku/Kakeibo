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
            $table->foreignId('transaction_type_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_child_categories');
    }
}
