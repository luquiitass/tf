<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Models\User;

Route::get('/prueba',function (){
    return view('comensal.index');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin',function (){
    return view('home');
});

Route::get('getUser',function (){
    if (!Auth::guest()){
        return response()->json(Auth::user()->load('comedores','roles','comensal'));
    }
    return response()->json(['no login'],402);
});


//ROUTE Usuario

//Route::get('/usuarios','Api\UsersController@index');
//Route::get('/usuarios/create','Api\UsersController@create');
//Route::get('/usuarios/{id}/edit','Api\UsersController@edit');
//Route::get('/usuarios/{id}','Api\UsersController@show');
//Route::get('/usuarios/getData','Api\UsersController@getData');
Route::post('/usuarios/getData','Api\UsersController@getData');

//Route::post('/usuarios','Api\UsersController@store');
//Route::put('/usuarios/{id}','Api\UsersController@update');
//Route::delete('/usuarios/{id}','Api\UsersController@destroy');
Route::get('/usuarios/search','Api\UsersController@search');
Route::resource('usuario','Api\UsersController');

//Route Comedor
Route::post('comedor/attachUsuario/{comedor}','Api\ComedoresController@attachUsuario');
Route::delete('comedor/detachUsuario/{comedor}','Api\ComedoresController@detachUsuario');
Route::post('comedores/getData','Api\ComedoresController@getData');
Route::get('comedores','Api\ComedoresController@index');
Route::resource('comedor','Api\ComedoresController');

Route::post('comensales/getData','Api\ComensalesController@getData');
Route::post('comensal/attachUsuario/{usuario}','Api\ComensalesController@attachUsuario');
Route::resource('comensal','Api\ComensalesController');



//Tipos de comidas
Route::get('tiposComida','Api\TiposComidaController@index');
Route::resource('tipoComida','Api\TiposComidaController');


