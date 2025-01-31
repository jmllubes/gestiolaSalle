<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incidence_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->longText('description');
            $table->dateTime('created_at'); 
        });
        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('incidence_id')->references('id')->on('incidence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('comments');
    }

}
