<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryWatchtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_watchtype', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('watchtype_name');
            $table->string('watchtype_price', 25);
            $table->tinyInteger('disabled_network', 4);
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
        Schema::dropIfExists('category_watchtype');
    }
}
