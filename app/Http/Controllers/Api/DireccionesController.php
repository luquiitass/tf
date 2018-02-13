<?php

namespace App\Http\Controllers\Api;

use App\Models\Direccion;
use App\Models\RetornoAjax;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class DireccionesController extends ApiController
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
        return Direccion::all();
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
       try{
           \DB::beginTransaction();
           $direccion = $request->get('direccion');

           if ($request->has('direccion.usuario_id')){
                $usuario = User::find($direccion['usuario_id']);
               $direccion = Direccion::create($direccion);
               $usuario->direccion_id = $direccion->id;
               $usuario->save();


           }else{
               return $this->jsonMensajeError('Error','No se ha indicado a que o quien pertenece la direccion');
           }
           \DB::commit();
           return $this->jsonMensajeData('Direccion registrada exitosamente','','success',$direccion);
       }catch (\Exception $e){
           \DB::rollBack();
           return $this->jsonMensajeError('Error',$e->getMessage());
       }

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            \DB::beginTransaction();
            $inputs = $request->get('direccion');



            $direccion = Direccion::findOrFail($id);

            //return $this->jsonMensajeError('Error',$inputs);


            $direccion->update($inputs);


            \DB::commit();
            return $this->jsonMensajeData('Direccion modificado exitosamente','','success',$direccion);
        }catch (\Exception $e){
            \DB::rollBack();
            return $this->jsonMensajeError('Error',$e->getMessage());
        }
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
