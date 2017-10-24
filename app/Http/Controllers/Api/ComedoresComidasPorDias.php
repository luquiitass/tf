<?php

namespace App\Http\Controllers\Api;


use App\Helper\Funciones;
use App\Http\Requests\ComedoresComidaPorDiaStoreRequest;
use App\Models\Comedor;
use App\Models\ComidaPorDia;

class ComedoresComidasPorDias extends ApiController
{
    //
    use Funciones;

    public function store(ComedoresComidaPorDiaStoreRequest $request){
        $comedor = Comedor::findOrFail($request->comedor_id);
        try {
            $tipoComida = request()->tipoComida;
            $dias = request()->dias;
            $inputs = $request->only('inicio', 'fin', 'horas_pre_inscripcion');

            //dd($inputs);

            $comidasPrDia = ComidaPorDia::query()
                ->where('tipo_comida_id', $tipoComida)
                ->whereIn('dia_id', $dias)
                ->get();

            $sync = array();

            foreach ($comidasPrDia as $com) {

                $sync[$com->id] = $inputs;
            }


            $comedor->comidasPorDia()->attach($sync);
        }catch (\Exception $e){

        }

        return $comedor->comidasPorDia;
    }
}
