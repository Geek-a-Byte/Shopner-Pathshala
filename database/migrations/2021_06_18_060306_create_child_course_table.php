<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_takes_course', function (Blueprint $table) {
            $table->increments('child_cid_takes');
            $table->integer('child_id')->unsigned()->nullable();
            $table->foreign('child_id')
                ->references('child_id')->on('childs')
                ->onDelete('set null');
            $table->string('course_code')->nullable();
            $table->foreign('course_code')
                ->references('course_code')->on('courses')
                ->onDelete('set null');
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
        Schema::dropIfExists('child_takes_course');
    }
}
