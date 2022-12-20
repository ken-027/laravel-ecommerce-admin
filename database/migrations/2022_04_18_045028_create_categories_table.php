<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->tinyInteger('published')->default(0);
            $table->integer('ordering');
            $table->text('tooltip_device');
            $table->text('tooltip_storage');
            $table->text('tooltip_condition');
            $table->text('tooltip_network');
            $table->text('tooltip_connectivity');
            $table->text('tooltip_watchtype');
            $table->text('tooltip_case_material');
            $table->text('tooltip_case_size');
            $table->text('tooltip_color');
            $table->text('tooltip_accessories');
            $table->text('tooltip_screen_size');
            $table->text('tooltip_screen_resolution');
            $table->text('tooltip_lyear');
            $table->text('tooltip_processor');
            $table->text('tooltip_ram');
            $table->string('fields_type', 50);
            $table->text('storage_title');
            $table->text('condition_title');
            $table->text('network_title');
            $table->text('connectivity_title');
            $table->text('case_size_title');
            $table->text('type_title');
            $table->text('case_material_title');
            $table->text('color_title');
            $table->text('accessories_title');
            $table->text('screen_size_title');
            $table->text('screen_resolution_title');
            $table->text('lyear_title');
            $table->text('processor_title');
            $table->text('ram_title');

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
        Schema::dropIfExists('categories');
    }
}
