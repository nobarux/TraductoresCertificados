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
Route::get('/', function () {
    return view('inicioP');
});

Route::get('/inicio', function () {
    return view('inicioP');
});

Route::get('/solicitudesRegistro', function () {
    return view('solicitudesRegistro');
});

////---------------------------------------------//////
Route::get('/solicitudesGeneral', function () {
    return view('solicitudesGeneral');
});

Route::get('/solicitudesSuspensas', function () {
    return view('solicitudesSuspensas');
});

Route::get('/reclamaciones', function () {
    return view('reclamaciones');
    
});

Route::get('/administracion', function () {
    //return view('welcome');
    return "Aqui van la pantalla de los roles";
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Rutas para la parte de administracion
Route::get('admin', 'AdminController@index')->middleware('auth');

//Rutas para las solicitudes 
Route::get('/solicitudes', 'SolicitudesController@indexSolicitud');
Route::get('/solicitudesSuspensas', 'SolicitudesController@indexSolicitudSuspensas');

//Rutas para el registro de traductores
Route::get('/traductores', 'TraductorController@indexTrad');
Route::get('/traductores/create', 'TraductorController@createTrad');
Route::get('/traductores/{trad}', 'TraductorController@showTrad');
Route::post('/traductores', 'TraductorController@storeTrad');
Route::get('/traductores/{trad}/edit', 'TraductorController@editTrad');
Route::patch('/traductores/{trad}', 'TraductorController@updateTrad');
Route::delete('/traductores/{trad}', 'TraductorController@deleteTrad');
