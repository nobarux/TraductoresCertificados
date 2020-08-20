<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Solicitudes;
use Faker\Generator as Faker;

$factory->define(Solicitudes::class, function (Faker $faker) {
    return [
        'nombre'=> $faker->name,
        'apellidos'=>$faker->lastName,
        'lugar_Nac'=>$faker->sentence,
        'edad'=> $faker->sentence,
        'nacionalidad'=>$faker->sentence,
        'prof_Ocup'=>$faker->sentence,
        'id_Idioma'=>$faker->randomDigitNotNull,
        'ci'=>$faker->randomDigitNotNull,
        'image_url'=>$faker->url,
        'ant_penales'=>$faker->sentence,
        'curriculum'=>$faker->url,
        'telefono'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'id_Estado'=>$faker->randomDigitNotNull,
        'anno'=>$faker->randomDigitNotNull,
        
    ];
});
