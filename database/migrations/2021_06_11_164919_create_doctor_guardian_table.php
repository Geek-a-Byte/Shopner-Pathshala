<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorGuardianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_guardian', function (Blueprint $table) {
            $table->increments('appointment_id');
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')
                ->references('doctor_id')->on('doctors')
                ->onDelete('set null');
            $table->timestamps();
            $table->integer('acct_holder_id')->unsigned()->nullable();
            $table->foreign('acct_holder_id')
                ->references('acct_holder_id')->on('Guardians')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_guardian');
    }
}
