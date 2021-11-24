<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('not')->nullable();
            $table->string('address');
            $table->string('payment')->default(0);
            $table->string('img_payment')->nullable();
            $table->integer('product_count');
            $table->integer('shipping_price');
            $table->double('price');
            $table->double('total');
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('area_id');
            $table->foreign('user_id')
                ->on('users')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')
                ->on('countries')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('area_id')
                ->on('areas')->references('id')
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
        Schema::dropIfExists('orders');
    }
}
