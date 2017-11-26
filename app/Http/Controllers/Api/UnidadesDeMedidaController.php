<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\RetornoAjax;
use App\Models\UnidadDeMedida;
use Illuminate\Http\Request;

use App\Http\Requests;

class UnidadesDeMedidaController extends ApiController
{
    use AjaxGetAttribute,RetornoAjax;

    public function attribute(UnidadDeMedida $unidadDeMedida){
        return $this->ajaxGetAtribute($unidadDeMedida);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadesDeMedidas = UnidadDeMedida::with('comedor')->get();
        return response()->json($unidadesDeMedidas);
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
     * @param Requests\UnidadeDeMedidaStoreRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UnidadeDeMedidaStoreRequest $request)
    {
        //dd($request->all());
        $unidad = UnidadDeMedida::create($request->only('nombre','abreviatura','publico','comedor_id'));
        $unidad->publico = $request->get('publico') ? 1 : 0;
        $unidad->save();
        return $this->jsonMensajeData('felicidades','Unidad de medida registrada','success',$unidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param Requests\UnidadeDeMedidaUpdateRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UnidadeDeMedidaUpdateRequest $request, $id)
    {
        //dd($request->all());
        try{
            $unidad = UnidadDeMedida::findOrFail($id);
            $unidad->update($request->only('nombre','abreviatura','publico','comedor_id'));
            $unidad->publico = $request->get('publico') ? 1 : 0;
            $unidad->save();
            $unidad->load('comedor');
        }catch (\Exception $e){
            dd($e);
        }
        return $this->jsonMensajeData('Felicidades','La unidad de medida ha sido modificada','success',$unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $unidad = UnidadDeMedida::findOrFail($id);
            $unidad->delete();

        }catch (\Exception $e){
            return $this->jsonMensajeError('Error',$e->getMessage());
        }
        return response('true');
    }
}
