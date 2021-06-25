<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChildIdToDoctorGuardian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_guardian', function (Blueprint $table) {
            //
            Schema::table('doctor_guardian', function (Blueprint $table) {
                $table->integer('child_id')->unsigned()->nullable();
                $table->foreign('child_id')
                    ->references('child_id')->on('childs')
                    ->onDelete('set null');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_guardian', function (Blueprint $table) {
            //
        });
    }
}
