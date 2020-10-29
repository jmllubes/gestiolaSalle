<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_rols', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->dateTime('created_at');
        });
        
        Schema::table('assigned_rols', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigned_rols');
    }
}
