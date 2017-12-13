<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\Ingrediente;
use App\Models\Receta;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;

use App\Http\Requests;
use phpDocumentor\Reflection\Types\Object_;

class RecetasController extends ApiController
{
    use AjaxGetAttribute,RetornoAjax;


    public function attribute(Receta $receta){
        return $this->ajaxGetAtribute($receta);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Receta::with('ingredientes','comedor')->get());
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
    public function store(Requests\RecetaStoreRequest $request)
    {
        $inputs = $request->only('nombre','porciones','preparacion','comedor_id');
        $ingredientes = $request->get('ingredientes');

        //dd($inputs);

        try{
            \DB::beginTransaction();

            $receta = Receta::create($inputs);

            foreach ($ingredientes as $ingrediente){

                $receta->ingredientes()->create($ingrediente);

            }
            \DB::commit();
            $receta->load('ingredientes');
            return $this->jsonMensajeData('Receta registrada','','success',$receta);

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
    public function show(Receta $receta)
    {
        $receta->load('ingredientes.insumo.unidadDeMedida');
        return response()->json($receta);
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
        $receta = Receta::find($id);

        $inputs = $request->only('nombre','porciones','preparacion','comedor_id');
        $ingredientes = $request->get('ingredientes');

        //dd($inputs);

        try{
            \DB::beginTransaction();

            $receta->update($inputs);

            $receta->ingredientes()->delete();

            //dd($ingredientes);

            foreach ($ingredientes as $ingrediente){
                $receta->ingredientes()->create($ingrediente);
            }

            //$receta->ingredientes->updateOrCreate($ingredientes);

            \DB::commit();
            $receta->load('ingredientes');
            return $this->jsonMensajeData('Receta Modificada','','success',$receta);

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

    public function getData()
    {
        return Receta::getData();
    }

    public function search($comedor_id){
        $filtros = ['comedor_id'=>$comedor_id];
        $insumos  = Receta::with('ingredientes')->search($filtros )->get();

        $retorno = $insumos->each(function ($item, $key) {
            return $item['text'] = $item->nombre;
        });
        return response()->json($insumos);
    }
}
