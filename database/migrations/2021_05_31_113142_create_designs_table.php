<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 100);
            $table->string('img' , 200);
            $table->string('shortDescription');
            $table->text('description');
            $table->integer('active')->default(0);

            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('cat_id')
                ->on('cats')->references('id');
            $table->foreign('user_id')
                ->on('users')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('designs');
    }
}
