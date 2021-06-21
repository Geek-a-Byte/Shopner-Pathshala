<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('result_id');
            $table->integer('child_id')->unsigned()->nullable();
            $table->foreign('child_id')
                ->references('child_id')->on('Childs')
                ->onDelete('set null');
            $table->string('test_code');
            $table->foreign('test_code')
                ->references('test_code')->on('tests')
                ->onDelete('set null');
            $table->integer('score');
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
        Schema::dropIfExists('results');
    }
}
