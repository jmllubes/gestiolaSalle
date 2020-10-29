<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidence', function (Blueprint $table) {
            $table->increments('id');
            $table->string('created_by');
            $table->string('subject');
            $table->integer('category')->unsigned();
            $table->text('description');
            $table->string('status')->default("Pendent");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidence');
    }
}
