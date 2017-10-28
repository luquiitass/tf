<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\Comedor;
use App\Models\Comida;
use Illuminate\Http\Request;

use App\Http\Requests;

class ComidasController extends ApiController
{
    use AjaxGetAttribute;

    public function attribute(Comida $comida){
        return $comida->ajaxGetAtribute($comida);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comedor = Comedor::findOrFail($request->comedor_id);
        try {
            $tipoComida = request()->tipo_comida_id;
            $dias = request()->dias;
            $inputs = $request->only('inicio', 'fin', 'hora_pre_inscripcion');


            $sync = array();

            foreach ($dias as $dia) {
                $comida =array_merge($inputs, ['tipo_comida_id'=>$tipoComida,'dia_id'=>$dia,'inicio']);
                $comedor->comidas()->create($comida);
            }



        }catch (\Exception $e){
            return response()->json($e->getMessage(),402);
        }

        return $comedor->comidasByTipoComida();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comida $comida)
    {
        return $comida->load('dia','tipoComida','comensales');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comedor = Comedor::findOrFail($request->comedor_id);
        try {
            $tipoComida = request()->tipo_comida_id;
            $dias = request()->dias;
            $inputs = $request->only('inicio', 'fin', 'hora_pre_inscripcion');


            $sync = array();

            $comedor->comidas()->where('tipo_comida_id',$tipoComida)->delete();

            foreach ($dias as $dia) {
                $comida =array_merge($inputs, ['tipo_comida_id'=>$tipoComida,'dia_id'=>$dia,'inicio']);

                $comedor->comidas()->create($comida);
            }



        }catch (\Exception $e){
            return response()->json($e->getMessage(),402);
        }

        return $comedor->comidasByTipoComida();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
