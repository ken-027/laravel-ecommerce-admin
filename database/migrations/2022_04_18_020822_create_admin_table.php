<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->string('name');
            $table->string('username', 100);
            $table->string('password');
            $table->string('email', 100);
            $table->string('type', 25);
            $table->string('pass_change_token');
            $table->dateTime('added_date')->useCurrent();
            $table->dateTime('uploaded_date')->useCurrent();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('admin');
    }
}
