<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbSolicitudesAdminsion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',255);
            $table->string('apellidos',255);
            $table->text('lugar_Nac');
            $table->string('edad');
            $table->string('nacionalidad',255);
            $table->string('prof_Ocup',255);
            $table->integer('id_Idioma');
            $table->integer('ci');
            $table->string('image_url');
            $table->string('ant_penales');
            $table->string('curriculum');
            $table->string('telefono',255);
            $table->string('email',255);
            $table->integer('id_Estado');
            $table->integer('anno');
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
        Schema::dropIfExists('tbSolicitudesAdminsion');
    }
}
