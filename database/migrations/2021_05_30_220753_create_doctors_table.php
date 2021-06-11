<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('doctor_id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')->on('normal_user')
                ->onDelete('set null');
            $table->string('doctor_name');
            $table->string('doctor_email_id')->unique();
            $table->string('password');
            $table->string('profile_photo')->default('default.jpg');
            $table->string('doctor_gender');
            $table->string('doctor_address');
            $table->string('doctor_designation');
            $table->timestamp('working_hour_from')->nullable();
            $table->timestamp('working_hour_to')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
