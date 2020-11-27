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
Route::get('/solicitudes', 'SolicitudController@index');
Route::view('/a', 'test');
Route::patch('/solicitudes/{soli}', 'SolicitudController@update');
Route::post('/solicitudesDocumentos', 'SolicitudController@store');
Route::get('/solicitudesSuspensas', 'SolicitudController@indexSolicitudSuspensas');
Route::get('/reclamaciones', 'SolicitudController@indexSolicitudReclamar');
Route::get('/solicitudesRegistro', 'SolicitudController@indexSolicitudRegistro');
Route::patch('/solicitudesInscr/{soli}', 'SolicitudController@aprobadosInscripcion');
Route::patch('/solicitudesPend/{soli}', 'SolicitudController@pendienteCalifUpdate');
Route::patch('/solicitudesAprob/{soli}', 'SolicitudController@aprobUpdate');
Route::patch('/solicitudesSusp/{soli}', 'SolicitudController@suspUpdate');
Route::patch('/solicitudesReclamar/{soli}', 'SolicitudController@reclamarUpdate');
Route::patch('/solicitudesReclamarRechazada/{soli}', 'SolicitudController@reclamarRechazado');
Route::get('/solicitudesRegistro/{soli}', 'SolicitudController@test');
Route::post('/inscripcionesDeneg/{soli}/{idDeneg?}/{razonDeneg?}', 'SolicitudController@inscripcionDeneg')->name('solicitud.updateIncs');
// Route::get('/solicitudesTest', 'SolicitudController@test');


//Descarga de archivos segun user
Route::get('/solicitudesDescFoto/descar/{soli}', 'SolicitudController@foto')->name('solicitudes.descFoto');
Route::get('/solicitudesDescCarnet1/desc/{soli}', 'SolicitudController@carnet1')->name('solicitudes.descCarnet1');
Route::get('/solicitudesDescCarnet2/desc/{soli}', 'SolicitudController@carnet2')->name('solicitudes.descCarnet2');
Route::get('/solicitudesDescTitulo/desc/{soli}', 'SolicitudController@tit')->name('solicitudes.descTit');
Route::get('/solicitudesDescAnte/desc/{soli}', 'SolicitudController@ante')->name('solicitudes.descAnte');

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

//Rutas para los usuarios 
Route::resource('roles', 'RolesController');//Esto se utiliza para rutear de manera sencilla todas las pantallas de un crud

//Rutas para el reporte
Route::get('/reporteTrad', 'ReporteController@reporteTrad');


Route::get('/reporteTrad/pdf','ReporteController@downloadPDF');



