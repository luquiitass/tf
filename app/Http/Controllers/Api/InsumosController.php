<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Http\Requests\InsumoStoreRequest;
use App\Http\Requests\InsumoUpdateRequest;
use App\Models\Insumo;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;


class InsumosController extends ApiController
{

    use AjaxGetAttribute,RetornoAjax;

    public function attribute(Insumo $insumo){
        return $this->ajaxGetAtribute($insumo);
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
     * @param InsumoStoreRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsumoStoreRequest $request)
    {
        try {
            $insumo = Insumo::create($request->only('nombre', 'minimo', 'comedor_id', 'unidad_de_medida_id', 'disponibilidad'));

        }catch (\Exception $e){
            return $this->jsonMensajeError('Error',$e->getMessage());
        }

        return $this->jsonMensajeData('Felicidades','Insumo registrado Correctamente','success',$insumo);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param InsumoUpdateRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsumoUpdateRequest $request, $id)
    {
        try{
            $insumo = Insumo::findOrFail($id);
            $insumo->update($request->only('nombre','disponibilidad','minimo'));
            $insumo->load('unidadDeMedida','comedor');
        }catch (\Exception $e){
            return $this->jsonMensajeError('Error',$e->getMessage());
        }

        return $this->jsonMensajeData('Felicidades','Insumo modificado correctamente','success',$insumo);

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

    public function getData()
    {
        return Insumo::getData();
    }
}
