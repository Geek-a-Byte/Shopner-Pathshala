<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrescriptionToDoctorGuardian extends Migration
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
                $table->string('prescription')->nullable();
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
