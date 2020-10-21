<?php

use App\Role;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            CategoriaSeeder::class,
//            UserSeeder::class,
//            // PostSeeder::class,
//            PaginaSeeder::class,
//            ConfigSeeder::class,
//            RoleSeeder::class,

            ProvinciaSeeder::class,
            MunicipioSeeder::class,
            ProfesionSeeder::class,
            TipoCertificacionSeeder::class
        ]);
    }
}
