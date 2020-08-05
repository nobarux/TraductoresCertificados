<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('solicitudesRegistro', function () {
    //return view('welcome');
    return "Aqui van las solicitudes de admision para los usuarios interesados";
});

////---------------------------------------------//////
Route::get('solicitudesGeneral', function () {
    //return view('welcome');
    return "Aqui se veran todas las solicitudes con sus respectivos estados";
});

Route::get('solicitudesSuspensas', function () {
    //return view('welcome');
    return "Aqui van las solicitudes de admision para los usuarios que suspendieron";
});

Route::get('reclamaciones', function () {
    //return view('welcome');
    return "Aqui van las solicitudes que tengan un estado reclamacion";
});

Route::get('roles', function () {
    //return view('welcome');
    return "Aqui van la pantalla de los roles";
});