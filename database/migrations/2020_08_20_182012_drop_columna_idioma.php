<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnaIdioma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbSolicitudesAdminsion', function (Blueprint $table) {
            $table->integer('id_Idioma');
            $table->dropColumn('idioma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbSolicitudesAdminsion', function (Blueprint $table) {
            //
        });
    }
}
