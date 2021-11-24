<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 100);
            $table->string('slug' , 100);
            $table->string('img' , 100);
            $table->string('alt');
            $table->double('price' , 10,);
            $table->double('discount' , 10)->default(0);
            $table->integer('percentage')->default(0);
            $table->text('description')->nullable();
            $table->string('shortDescription')->nullable();
            $table->integer('premium')->default(0);
            $table->integer('available')->default(1);
            $table->string('meta_description')->nullable();
            $table->string('seo_title');
            $table->string('keyword_tag')->nullable();
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
        Schema::dropIfExists('products');
    }
}
