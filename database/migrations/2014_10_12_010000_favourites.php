<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Favourites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->increments('id');
	    $table->integer('user_id')->unsigned();
            $table->string('markets')->nullable(true);
            $table->string('bnb')->nullable(true);
            $table->string('btc')->nullable(true);
            $table->string('eth')->nullable(true);
            $table->string('usdt')->nullable(true);
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
        Schema::dropIfExists('favourites');
    }
}
