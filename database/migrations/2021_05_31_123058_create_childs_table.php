<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childs', function (Blueprint $table) {
            $table->increments('child_id');
            $table->increments('guardian_id');
            $table->foreign('guardian_id')->references('acct_holder_id')->on('guardians')->onDelete('cascade');
            $table->string('child_name');
            $table->string('child_father_name');
            $table->string('child_mother_name');
            $table->string('child_father_phone_num')->nullable();
            $table->string('child_mother_phone_num')->nullable();
            $table->string('child_father_email_id')->nullable();
            $table->string('child_mother_email_id')->nullable();
            $table->string('child_age');
            $table->string('child_gender');
            $table->string('child_address');
            $table->string('child_eating_habit');
            $table->string('child_special_skill')->nullable();
            $table->string('child_hobby');
            $table->string('child_repeatative_behaviour')->nullable();
            $table->string('child_autism_type')->nullable();
            $table->string('child_communication_skill')->nullable();
           
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
        Schema::dropIfExists('childs');
    }
}
