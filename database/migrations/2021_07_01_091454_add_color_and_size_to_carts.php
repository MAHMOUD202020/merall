<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorAndSizeToCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {

            $table->dropColumn('color');
            $table->string('color_name' , 100)->nullable()->after('price');
            $table->string('color_img' , 100)->nullable()->after('price');
            $table->string('size_name' , 100)->nullable()->after('price');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {

            $table->dropColumn('color_name');
            $table->dropColumn('color_img');
            $table->dropColumn('size_name');

        });
    }
}
