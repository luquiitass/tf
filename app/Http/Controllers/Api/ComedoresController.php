<?php

namespace App\Http\Controllers\Api;

use App\Helper\Funciones;
use App\Http\Requests\ComedorSstoreRequest;
use App\Http\Requests\ComedorUpdateRequest;
use App\Models\Comedor;
use App\Http\Requests\ComensalStoreRequest;
use Illuminate\Http\Request;
use PhpParser\Error;

class ComedoresController extends ApiController
{
    use Funciones;

    public function getData()
    {
        $columns = Comedor::$columns;
        $model = Comedor::searchPaginateAndOrder();

        return response()
            ->json([
                'model' => $model,
                'columns' => $columns
            ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comedor::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param ComedorSstoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComedorSstoreRequest $request)
    {
        try {
            \DB::beginTransaction();
            $inputs = request()->only('nombre', 'creado');
            $inputs['activo']=0;
            $comedor = Comedor::create($inputs);
            $administradores = $request->get('administradores');

            //dd(self::getIds($administradores));

            $comedor->administradores()->sync(self::getIds($administradores));
            $comedor->load('administradores');
            \DB::commit();
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json($e->getMessage(),422);
        }

        return $comedor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comedor $comedor)
    {
        $comedor->load('administradores');
        return view('comedor.show',compact('comedor'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComedorUpdateRequest $request, $id)
    {
        try {
            \DB::beginTransaction();
            $comedor = Comedor::findOrFail($id);
            $comedor->update(request()->only('nombre', 'creado'));
            $administradores = $request->get('administradores');

            //dd(self::getIds($administradores));

            $comedor->administradores()->sync(self::getIds($administradores));
            $comedor->load('administradores');

            \DB::commit();

            return $comedor;
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json($e->getMessage(),422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comedor $comedor)
    {
        try{
            $comedor->delete();
        }catch (\Exception $e){
            return response()->json('Primedo debe eliminar todos los registros de un comedor',442);
        }
        return response('true');
    }
}
