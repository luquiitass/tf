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

Route::get('/prueba',function (){
   return 'prueba';
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin',function (){
    return view('home');
});


//ROUTE Usuario

Route::get('/usuarios','Api\UsersController@index');
Route::get('/usuarios/create','Api\UsersController@create');
Route::get('/usuarios/{id}/edit','Api\UsersController@edit');
Route::get('/usuarios/getData','Api\UsersController@getData');
Route::post('/usuarios/getData','Api\UsersController@getData');

Route::post('/usuarios','Api\UsersController@store');
Route::put('/usuarios/{id}','Api\UsersController@update');
Route::delete('/usuarios/{id}','Api\UsersController@destroy');
Route::get('/usuarios/search','Api\UsersController@search');

//Route Comedor

Route::get('comedor/getData','Api\ComedoresController@getData');
Route::get('comedor','Api\ComedoresController@index');
Route::resource('comedor','Api\ComedoresController');


