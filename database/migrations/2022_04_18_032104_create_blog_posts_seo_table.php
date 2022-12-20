<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts_seo', function (Blueprint $table) {
            $table->id();
            $table->string('postTitle');
            $table->string('meta_title');
            $table->string('meta_desc');
            $table->string('meta_keywords');
            $table->string('postSlug');
            $table->text('postDesc');
            $table->text('postCont');
            $table->string('image');
            $table->dateTime('postDate')->useCurrent();
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
        Schema::dropIfExists('blog_posts_seo');
    }
}
