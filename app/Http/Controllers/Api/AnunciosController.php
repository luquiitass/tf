<?php

namespace App\Http\Controllers\Api;

use App\Models\Anuncio;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;

use App\Http\Requests;

class AnunciosController extends ApiController
{
    use RetornoAjax;
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
    public function store(Requests\AnuncioStoreRequest $request)
    {
        $anuncio = Anuncio::create( $request->only('asunto','cuerpo','hasta','user_id','comedor_id') );
        $anuncio->load('usuario');

        return $this->jsonMensajeData('Felicidades','Anuncio registrado exitosamente','success',$anuncio);
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
    public function update(Requests\AnuncioUpdateRequest $request, $id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->update($request->only('asunto','cuerpo','hasta','usuario_id'));

        return $this->jsonMensajeData('Felicidades','Anuncio modificado','success',$anuncio);
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
            $anuncio = Anuncio::findOrFail($id);
            $anuncio->delete();
            return response('true');
        }catch (\Exception $e){
            return $this->jsonMensajeError($e->getMessage());
        }
    }
}
