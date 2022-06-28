<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimestablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timestables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->time('start_time')->default('00:00:00');
            $table->time('end_time')->default('07:59:59');
            $table->integer('interval')->default(8);
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
        Schema::dropIfExists('timestables');
    }
}
