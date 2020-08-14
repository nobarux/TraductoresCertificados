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
    return view('welcome');
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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', 'AdminController@index');