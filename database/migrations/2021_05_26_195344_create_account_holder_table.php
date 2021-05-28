<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHolderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_holder', function (Blueprint $table) {
            $table->increments('acct_holder_id');
            $table->string('acct_holder_name');
            $table->string('acct_holder_email')->unique();
            $table->string('acct_holder_password');
            $table->string('acct_holder_address');
            $table->string('relation_with_child');
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
        Schema::dropIfExists('account_holder');
    }
}
