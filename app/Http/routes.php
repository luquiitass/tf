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

    try{
        DB::beginTransaction();

        $id = request()->get('instancia');

        if ($id){
            $intancia = \App\Models\Instancia::find($id);

            //dd($intancia->comida->fecha);

            echo  'Fecha :' .$intancia->comida->fecha;
            echo  '\n Hora inicio :' .$intancia->comida->inicio;
            echo  '\n Hora pre inscripcion :' .$intancia->comida->hora_pre_inscripcion;
            echo  ' Hora pre inscripcion :' . $intancia->comida->cierreInscripcion;
            /*if ($intancia){
                $intancia->finalizarInstancia();
                $retorno = $intancia;
            }else{
                echo 'no existe instancia';
            }*/

        }else{
            echo 'Falta instancia';
        }


        DB::commit();

    }catch (Exception $e){
        // dd( $e->getMessage());
        DB::rollBack();
        dd( $e);
    }

    return $retorno;
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
Route::get('comedor/{comedor}/crearInstancias','Api\ComedoresController@crearInstancias');
Route::get('comedor/{comedor}/attribute','Api\ComedoresController@attribute');
Route::post('comedor/attachUsuario/{comedor}','Api\ComedoresController@attachUsuario');
Route::delete('comedor/detachUsuario/{comedor}','Api\ComedoresController@detachUsuario');
Route::post('comedores/getData','Api\ComedoresController@getData');
Route::get('comedores','Api\ComedoresController@index');
Route::resource('comedor','Api\ComedoresController');

Route::get('comensal/{comensal}/attribute','Api\ComensalesController@attribute');
Route::post('comensal/cambiarInscripcion/{comensal}' , 'Api\ComensalesController@cambiarInscripcion');
Route::post('comensales/getData','Api\ComensalesController@getData');
Route::post('comensal/attachUsuario/{usuario}','Api\ComensalesController@attachUsuario');
Route::resource('comensal','Api\ComensalesController');



//Tipos de comidas
//Route::get('tiposComida','Api\TiposComidaController@index');
Route::resource('tipoComida','Api\TiposComidaController');

//Dias
Route::resource('dia','Api\DiasController');


//Comedores comidas por dia
Route::get('comida/{comida}/attribute','Api\ComidasController@attribute');
Route::resource('comida','Api\ComidasController');

Route::resource('direccion/','Api\DireccionesController');

Route::get('pais/{pais}/attribute','Api\PaisesController@attribute');
Route::resource('pais','Api\PaisesController');

Route::get('provincia/{provincia}/attribute','Api\ProvinciasController@attribute');
Route::resource('provincia','Api\ProvinciasController');

Route::resource('localidad','Api\LocalidadesController');


Route::resource('anuncio','Api\AnunciosController');

Route::get('instancia/{instancia}/attribute','Api\InstanciasController@attribute');
Route::resource('instancia','Api\InstanciasController');


Route::get('estado/{estado}/attribute','Api\EstadosController@attribute');
Route::resource('estado','Api\EstadosController');


Route::get('unidadDeMedida/{unidadDeMedida}/attribute','Api\UnidadesDeMedidaController@attribute');
Route::resource('unidadDeMedida','Api\UnidadesDeMedidaController');

Route::get('/insumo/comedor/{comedor}/search','Api\InsumosController@search');
Route::get('insumo/{insumo}/attribute','Api\InsumosController@attribute');
Route::post('insumo/getData','Api\InsumosController@getData');
Route::resource('insumo','Api\InsumosController');

Route::get('/receta/comedor/{comedor}/search','Api\RecetasController@search');
Route::post('receta/getData','Api\RecetasController@getData');
Route::get('receta/{receta}/attribute','Api\RecetasController@attribute');
Route::resource('receta','Api\RecetasController');

Route::get('menu/{menu}/attribute','Api\MenusController@attribute');
Route::resource('menu','Api\MenusController');




Route::put('configuracionesComedor/{id}/inicioFin','Api\ComedorConfiguracionesController@inicioFin');


//Ajax directo
Route::get('attribute/{clase}/{id}/{attribute}','Api\InstanciasController@getAtribute');
Route::get('function/{clase}/{id}/{function}','Api\InstanciasController@runFunction');
Route::get('model/{clase}/{function}','Api\InstanciasController@runMethodStatic');