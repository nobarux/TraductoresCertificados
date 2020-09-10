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

/*Route::get('/', function () {
    return view('welcome');
});*/

////---------------------------------------------//////


Route::get('/reclamaciones', function () {
    return view('reclamaciones');
    
});

Auth::routes();

Route::get('/', 'HomeController@index');
//Rutas para la parte de administracion
Route::get('admin', 'AdminController@index')->middleware('auth');

//Rutas para las solicitudes 
Route::get('/solicitudes', 'SolicitudesController@indexSolicitud');
Route::get('/solicitudesSuspensas', 'SolicitudesController@indexSolicitudSuspensas');
Route::get('/solicitudesRegistro', 'SolicitudesController@indexSolicitudRegistro');
Route::patch('/solicitudes/{soli}', 'SolicitudesController@aprobadosUpdate');
Route::patch('/solicitudesPend/{soli}', 'SolicitudesController@pendienteCalifUpdate');
Route::patch('/solicitudesAprob/{soli}', 'SolicitudesController@aprobUpdate');
Route::patch('/solicitudesSusp/{soli}', 'SolicitudesController@suspUpdate');
Route::patch('/solicitudesReclamar/{soli}', 'SolicitudesController@reclamarUpdate');
Route::get('/solicitudesRegistro/{soli}', 'SolicitudesController@test');

//Rutas para el registro de traductores
// Route::get('/traductores', 'TraductorController@index');
// Route::get('/traductores/create', 'TraductorController@create');
// Route::get('/traductores/{trad}', 'TraductorController@show');
// Route::post('/traductores', 'TraductorController@store');
// Route::get('/traductores/{trad}/edit', 'TraductorController@edit');
// Route::patch('/traductores/{trad}', 'TraductorController@update');
// Route::delete('/traductores/{trad}', 'TraductorController@destroy');
Route::resource('traductores', 'TraductorController');//Esto se utiliza para rutear de manera sencilla todas las pantallas de un crud

//Rutas para los usuarios
Route::resource('usuarios', 'UserController');//Esto se utiliza para rutear de manera sencilla todas las pantallas de un crud
