<?php

use Illuminate\Database\Seeder;
use App\Razones;

class RazonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Razones::create(['descripciones' =>  "No es mayor de 18 años" ]);
        Razones::create([ 'descripciones' =>  "No es graduado de nivel superior" ]);
        Razones::create([ 'descripciones' =>  "No reside de manera permanente en Cuba"]);
        Razones::create([ 'descripciones' =>  "Tiene antecedentes penales"]);
        Razones::create([ 'descripciones' =>  "El título adjuntado no es correcto"]);
        Razones::create([ 'descripciones' =>  "Otros"]);
    }
}
