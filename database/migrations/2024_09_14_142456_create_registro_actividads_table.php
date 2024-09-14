<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_actividad', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario');
            $table->date('fecha');
            $table->time('hora');
            $table->time('tiempo');
            $table->string('actividad');
            $table->integer('puntuacion');
            $table->string('observaciones');
            $table->binary('ruta');
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
        Schema::dropIfExists('registro_actividad');
    }
}
