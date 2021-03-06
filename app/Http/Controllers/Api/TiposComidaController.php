<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TipoComidaStoreRequest;
use App\Http\Requests\TipoComidaUpdateRequest;
use App\Models\Comedor;
use App\Models\ComidaPorDia;
use App\Models\Dia;
use App\Models\TipoComida;
use Illuminate\Http\Request;


class TiposComidaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoComida::get();

        return response()->json($tipos);

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
    public function store(TipoComidaStoreRequest $request)
    {
        try {
            \DB::beginTransaction();
            $tipo = TipoComida::create($request->only('nombre'));
            \DB::commit();
            return response()->json($tipo);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json(['error'=>$e->getMessage()],402);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TipoComidaUpdateRequest|Request $request
     * @param TipoComida $tipoComida
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(TipoComidaUpdateRequest $request, $tipoComida)
    {
        $tipoComida = TipoComida::findOrFail($tipoComida);

        try {
            \DB::beginTransaction();
                $tipoComida->update($request->only('nombre'));
            \DB::commit();
            return response()->json($tipoComida);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json(['error'=>$e->getMessage()],402);
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
        $tipo = TipoComida::findOrFail($id);
        try{
            $tipo->delete();

        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }
        return response('true');
    }
}
