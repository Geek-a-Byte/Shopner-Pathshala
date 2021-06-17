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
            $table->timestamps();
            $table->integer('acct_holder_id')->unsigned()->nullable();
            $table->foreign('acct_holder_id')
                ->references('acct_holder_id')->on('Guardians')
                ->onDelete('set null');
            $table->string('child_name');
            $table->string('child_age');
            $table->string('child_gender');
            $table->string('father_name');
            $table->string('father_phone_no')->nullable();
            $table->string('father_email')->nullable();
            $table->string('mother_name');
            $table->string('mother_phone_no')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('communication_skill');
            $table->string('special_skill')->nullable();
            $table->string('eating_habit');
            $table->string('hobby')->nullable();
            $table->string('autism_type')->nullable();
            $table->string('repeatative_behaviour');
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
