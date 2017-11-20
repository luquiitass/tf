<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\Estado;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;

use App\Http\Requests;

class EstadosController extends ApiController
{
    use AjaxGetAttribute,RetornoAjax;

    public function attribute(Estado $estado){
        return $this->ajaxGetAtribute($estado);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('tabla')){
            $estados = Estado::where('tabla',request()->get('tabla'))->get();
        }else{
            $estados =  Estado::get();
        }

        return response()->json($estados);
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
     * @param Requests\EstadoSaveRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\EstadoSaveRequest $request)
    {
        $posicion = Estado::where('tabla',$request->get('tabla'))->count() + 1 ;
        $request->posicion = $posicion;
        $estado = Estado::create($request->only('nombre','tabla','posicion'));

        return $this->jsonMensajeData('Felicidades','Estado registrado','success',$estado);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
