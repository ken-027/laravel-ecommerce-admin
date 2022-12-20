<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_accessories', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('accessories_name');
            $table->string('plus_minus', 2);
            $table->string('fixed_percentage', 25);
            $table->string('accessories_price', 25);
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
        Schema::dropIfExists('category_accessories');
    }
}
