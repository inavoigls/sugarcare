<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroGlucosasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_glucosa', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario');
            $table->date('fecha');
            $table->float('glucosa');
            $table->time('hora');
            $table->timestamps();
            $table->foreign('users')->references('id')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_glucosa');
    }
}
