<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\Comensal;
use App\Http\Requests\ComensalStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ComensalesController extends ApiController
{

    use AjaxGetAttribute;


    public function attribute(Comensal $comensal){

        return $this->ajaxGetAtribute($comensal);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComensalStoreRequest $request)
    {
        try{
            \DB::beginTransaction();
            $comedor_id = $request->get('comedor_id');
            $usuario = User::create($request->all());
            $usuario->comensal()->create(['comedor_id'=>$comedor_id]);
            $usuario->setFoto($request->foto);
            $usuario->id = $usuario->comensal->id;
            \DB::commit();
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json(['error'=>$e->getMessage()],402);
        }
        return response()->json($usuario);

    }

    /**
     * Display the specified resource.
     *
     * @param Comensal $comensal
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Comensal $comensal)
    {
        $comensal->load('usuario');
        return $comensal;
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

    public function attachUsuario(User $usuario){

        //dd($usuario);
        $comedor_id = request()->get('comedor_id');
        if (!Comensal::where('user_id',$usuario->id)->where('comedor_id',$comedor_id)->first()){
            $usuario->comensal()->create(['comedor_id'=>$comedor_id]);
        }else{
            return response()->json(['error'=>'El comensal ya existe'],402);
        }
        $usuario->id = $usuario->comensal->id;
        return $usuario->load('comensal');
    }

    public function cambiarInscripcion(Comensal $comensal){
        $comida = request()->get('comida');
        //dd($comensal->inscripciones->where('id' , $comida['id']));
        if ($comensal->inscripciones->where('id' , $comida['id'])->first()){
            $comensal->inscripciones()->detach($comida['id']);
        }else{
            $comensal->inscripciones()->attach($comida['id']);
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

    /**
     * @return mixed
     */
    public function getData()
    {
        $idComedor = request()->get('comedor');
        return Comensal::getData($idComedor);
    }

}