<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\Provincia;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProvinciasController extends ApiController
{
    use RetornoAjax,AjaxGetAttribute;


    public function attribute(Provincia $provincia){
        return $this->ajaxGetAtribute($provincia);
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
     * @param Requests\ProvinciaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ProvinciaStoreRequest $request)
    {
        $provincia = Provincia::create($request->only('nombre','pais_id'));
        return $this->jsonMensajeData('Felicitaciones','La provincia ha sido registrado exitosamente','info',$provincia);

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
    public function update(Requests\ProvinciaUpdateRequest $request, $id)
    {
        //
        $provincia = Provincia::findOrFail($id);

        $provincia->update($request->only('nombre','pais_id'));

        return $this->jsonMensajeData('Felicitaciones','Nombre de la provincia ha sido modificado','success',$provincia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provincia = Provincia::findOrFail($id);
        try{
            $provincia->delete();
            return response('true');
        }catch (\Exception $e){
            return response()->json($e->getMessage(),422);
        }
    }
}
