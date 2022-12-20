<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_color', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('color_name');
            $table->string('color_code', 10);
            $table->string('plus_minus', 2);
            $table->string('fixed_percentage', 25);
            $table->string('color_price', 25);
            $table->text('storage_ids');
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
        Schema::dropIfExists('category_color');
    }
}
