<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePakaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bahan_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->decimal('jumlah', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pakai');
    }
}
