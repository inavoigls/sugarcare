<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesosEstaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesos_estatura', function (Blueprint $table) {
            $table->id();
            $table->float('estatura');
            $table->float('pequeña');
            $table->float('media');
            $table->float('grande');
            $table->string('genero');;
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
        Schema::dropIfExists('pesos_estatura');
    }
}
