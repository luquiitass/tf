<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Inscripcion;
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
        $comensal->load('usuario','inscripcionesByDate');

        if (!request()->ajax()){
            $comensal->load('comedor'/*,'comedor.comidas','comedor.anunciosActivos','presencias'*/,'usuario.direccion');
            $usuario =$comensal->usuario;// \Auth::user()->load('direccion');
            return view('comensal.show',compact('usuario','comensal'));
        }else{

        }

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

        $inscripcion = ['comida_id'=>$comida['id'],'user_id'=>\Auth::user()->id,'fecha'=>$comida['fecha']['date']];

        //dd($comida);
        if ($comensal->comidas->where('id' , $comida['id'])->first()){
            $comensal->comidas()->detach($comida['id']);
            $insc = $comensal->inscripciones()->create( array_merge($inscripcion,['inscripto'=>0]));

        }else{
            $comensal->comidas()->attach($comida['id']);
            $insc = $comensal->inscripciones()->create( array_merge($inscripcion,['inscripto'=>1]));
        }

        return $insc->load('comida','usuario');

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
