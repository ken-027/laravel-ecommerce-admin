<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_ram', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->integer('ram_size');
            $table->string('ram_size_postfix', 3);
            $table->string('ram_price', 25);
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
        Schema::dropIfExists('category_ram');
    }
}
