<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\Localidad;
use App\Models\RetornoAjax;
use FontLib\Table\Type\loca;
use Illuminate\Http\Request;

use App\Http\Requests;

class LocalidadesController extends ApiController
{
    use RetornoAjax,AjaxGetAttribute;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Localidad::get());
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
     * @param Requests\LocalidadStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\LocalidadStoreRequest $request)
    {
        $localidad = Localidad::create($request->only('nombre','provincia_id'));

        return $this->jsonMensajeData('Felicitaciones','La Localidad ha sido registrado exitosamente','info',$localidad);

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
        $localidad = Localidad::findOrFail($id);

        $localidad->update($request->only('nombre'));

        return $this->jsonMensajeData('Felicitaciones','Nombre de la localidad ha sido modificado','success',$localidad);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localidad = Localidad::findOrFail($id);
        try{
            $localidad->delete();
            return response('true');
        }catch (\Exception $e){
            return response()->json($e->getMessage(),422);
        }
    }
}
