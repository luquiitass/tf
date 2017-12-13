<?php

namespace App\Http\Controllers\Api;

use App\Helper\AjaxGetAttribute;
use App\Models\ComedorConfiguracion;
use App\Models\RetornoAjax;
use Illuminate\Http\Request;

use App\Http\Requests;

class ComedorConfiguracionesController extends ApiController
{
    use RetornoAjax,AjaxGetAttribute;

    public function inicioFin(Request $request,$id){
        $inputs = $request->only('inicia','finaliza');

        $configuraciones = ComedorConfiguracion::find($id);

        $configuraciones->inicia = $inputs['inicia'];
        $configuraciones->finaliza = $inputs['finaliza'];

        $configuraciones->save();

        return $this->jsonMensajeData('Configuracion Modificada','','success',$configuraciones);
    }
}
