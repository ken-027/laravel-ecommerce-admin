<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_networks', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('network_name');
            $table->string('network_icon');
            $table->string('network_price', 25);
            $table->string('network_unlock_price', 25);
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
        Schema::dropIfExists('category_networks');
    }
}
