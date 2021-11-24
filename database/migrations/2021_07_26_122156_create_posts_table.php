<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug' , 100);
            $table->string('subtitle');
            $table->string('img' , 50);
            $table->string('shortDescription');
            $table->text('description');
            $table->string('tags')->nullable();
            $table->integer('visits')->default(0);
            $table->boolean("is_published")->default(true);

            $table->string('meta_description');
            $table->string('seo_title' , 100);


            $table->foreignId('catBlog_id')
                ->references('id')->on('cat_blogs')
                ->cascadeOnUpdate()->onDelete(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
