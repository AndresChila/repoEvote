<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVotacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votacions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombrevotacion')->nullable();
            $table->bigInteger('tipovotacion')->nullable();
            $table->dateTime('fechainicio')->nullable();
            $table->dateTime('fechafin')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('votacions');
    }
}
