<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_storage', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->integer('storage_size');
            $table->string('storage_size_postfix', 3);
            $table->tinyInteger('top_seller');
            $table->string('storage_price', 25);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_storage');
    }
}
