<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hosp_no');
            $table->string('surn_name');
            $table->string('fore_name');
            $table->dateTime('dob');
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('requesting_consultant')->nullable();
            $table->string('address_for_copies')->nullable();
            $table->string('nhs_no')->nullable();
            $table->string('hospital')->nullable();
            $table->string('consultant')->nullable();
            $table->string('ward')->nullable();
            $table->text('address')->nullable();
            $table->boolean('nhs')->nullable();
            $table->boolean('private')->nullable();
            $table->boolean('category')->nullable();
            $table->boolean('other')->nullable();
            $table->string('signature')->nullable();
            $table->string('lab_no');
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
        Schema::dropIfExists('users');
    }
}
