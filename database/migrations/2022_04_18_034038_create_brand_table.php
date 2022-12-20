<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sef_url');
            $table->string('meta_title');
            $table->string('meta_desc');
            $table->string('meta_keywords');
            $table->string('image');
            $table->text('description');
            $table->tinyInteger('is_check_icloud')->default(0);
            $table->tinyInteger('published')->default(0);
            $table->integer('ordering');
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
        Schema::dropIfExists('brand');
    }
}
