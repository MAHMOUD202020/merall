<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_carts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('count');
            $table->double('price');
            $table->double('total');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('cart_id');
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cart_id')
                ->references('id')->on('carts')
                ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('order_carts');
    }
}
