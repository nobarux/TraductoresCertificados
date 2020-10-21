<?php

use Illuminate\Database\Seeder;
use App\TipoCertificacion;

class TipoCertificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCertificacion::create(['nombre' =>  "Traductor" ]);
        TipoCertificacion::create([ 'nombre' =>  "Intérprete" ]);
        TipoCertificacion::create([ 'nombre' =>  "Traductor e Intérprete"]);
    }
}
