<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->string('teacher_name');
            $table->string('teacher_email_id')->unique();
            $table->string('teacher_password');
            $table->string('teacher_gender');
            $table->string('teacher_address');
            $table->rememberToken();
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
        //
        Schema::dropIfExists('teacher');
    }
}
