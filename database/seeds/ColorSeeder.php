<?php

use Illuminate\Database\Seeder;
use App\ColorPiel;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ColorPiel::create(['descripcion' =>  "Blanco" ]);
        ColorPiel::create([ 'descripcion' =>  "Negro" ]);
        ColorPiel::create([ 'descripcion' =>  "Mestizo"]);
    }
}
