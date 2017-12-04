<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Http\Requests\ComidaStoreRequst;
use App\Models\Comedor;
use App\Models\Comida;
use App\Models\Dia;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;

use App\Http\Requests;

class ComidasController extends ApiController
{
    use AjaxGetAttribute,RetornoAjax;

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
     * @param ComidaStoreRequst|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComidaStoreRequst $request)
    {
        $comedor = Comedor::findOrFail($request->comedor_id);
        try {
            $tipoComida = request()->tipo_comida_id;
            $dias = Dia::get();
            $misDias = request()->dias;
            $inputs = $request->only('inicio', 'fin', 'hora_pre_inscripcion');

            foreach ($dias as $dia) {
                $comida =array_merge($inputs, ['tipo_comida_id'=>$tipoComida,'dia_id'=>$dia->id,'activo' => in_array($dia->id,$misDias)]);
                $comedor->comidas()->create($comida);
            }


        }catch (\Exception $e){
            return $this->jsonMensajeError('Error',$e->getMessage());//response()->json($e->getMessage(),402);
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
        $comidas = $request->comidas;
        //dd($comidas);
        foreach ($comidas as $comida){
            $unaComida = Comida::find($comida['id']);
            $unaComida->update($comida);
        }

        /*$comedor = Comedor::findOrFail($request->comedor_id);
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
    */
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
