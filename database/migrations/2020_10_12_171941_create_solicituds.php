<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicituds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            //personales
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('carnet');
            $table->bigInteger('profesion');
            $table->string('sexo');
            $table->string('direccion');
            $table->bigInteger('provincia');
            $table->string('municipio');
            $table->string('telefono_fijo')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->string('email');

            //certificacion
            $table->bigInteger('idioma');
            $table->integer('certificacion');

            //archivos
            $table->string('file_foto');
            $table->string('file_carnet1');
            $table->string('file_carnet2');
            $table->string('file_titulo');
            $table->string('file_antecedentes');

            //proceso
            $table->string('referencia')->nullable();
            $table->bigInteger('estado')->default(null);
            $table->string('transaccionENZONA')->nullable();

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
        Schema::dropIfExists('solicituds');
    }
}
