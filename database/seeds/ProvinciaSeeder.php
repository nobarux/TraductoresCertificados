<?php

use Illuminate\Database\Seeder;
use App\Provincia;
class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create(['nombre' =>  "Pinar del Río", 'dpa' =>  "21" ]);
        Provincia::create([ 'nombre' =>  "Artemisa", 'dpa' =>  "22" ]);
        Provincia::create([ 'nombre' =>  "La Habana", 'dpa' =>  "23" ]);
        Provincia::create([ 'nombre' =>  "Mayabeque", 'dpa' =>  "24" ]);
        Provincia::create([ 'nombre' =>  "Matanzas", 'dpa' =>  "25" ]);
        Provincia::create([ 'nombre' =>  "Cienfuegos", 'dpa' =>  "27" ]);
        Provincia::create([ 'nombre' =>  "Villa Clara", 'dpa' =>  "26" ]);
        Provincia::create([ 'nombre' =>  "Sancti Spíritus", 'dpa' =>  "28" ]);
        Provincia::create([ 'nombre' =>  "Ciego de Ávila", 'dpa' =>  "29" ]);
        Provincia::create([ 'nombre' =>  "Camagüey", 'dpa' =>  "30" ]);
        Provincia::create([ 'nombre' =>  "Las Tunas", 'dpa' =>  "31" ]);
        Provincia::create([ 'nombre' =>  "Granma", 'dpa' =>  "33" ]);
        Provincia::create([ 'nombre' =>  "Holguín", 'dpa' =>  "32" ]);
        Provincia::create([ 'nombre' =>  "Santiago de Cuba", 'dpa' =>  "34" ]);
        Provincia::create([ 'nombre' =>  "Guantánamo", 'dpa' =>  "35" ]);
        Provincia::create([ 'nombre' =>  "Municipio Especial Isla de la Juventud", 'dpa' =>  "36" ]);
    }
}
