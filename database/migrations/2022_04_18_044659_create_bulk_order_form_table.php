<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkOrderFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_order_form', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 100);
            $table->string('phone', 15);
            $table->string('country', 100);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->integer('zip_code');
            $table->text('devices');
            $table->string('company_name');
            $table->text('content');
            $table->dateTime('date')->useCurrent();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('bulk_order_form');
    }
}
