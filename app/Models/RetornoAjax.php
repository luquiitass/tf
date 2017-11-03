<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 01/11/17
 * Time: 15:41
 */

namespace App\Models;

use phpDocumentor\Reflection\Types\Object_;


trait RetornoAjax
{


    private function jsonMensaje($estado ,$titulo,$mens,$tipo = 'info'){
        $mensaje = new Object_();
        $mensaje->titulo = $titulo;
        $mensaje->mensaje= $mens;
        $mensaje->tipo = $tipo;

        return response()->json(['simple-mensaje'=>['mensaje'=>$mensaje]],$estado);
    }

    public function jsonMensajeURL($titulo,$mens,$tipo,$estado,$url){
        $mensaje = new Object_();
        $mensaje->titulo = $titulo;
        $mensaje->mensaje= $mens;
        $mensaje->tipo = $tipo;
        $mensaje->url = $url;
        return response()->json(['url-mensaje'=>['mensaje'=>$mensaje]],$estado);
    }

    public function jsonMensajeData($titulo,$mens,$tipo,$data){
        $mensaje = new Object_();
        $mensaje->titulo = $titulo;
        $mensaje->mensaje= $mens;
        $mensaje->tipo = $tipo;
        return response()->json(['data-mensaje'=>['mensaje'=>$mensaje,'data'=>$data]],200);
    }


    public function jsonMensajeOk($titulo,$mensaje){
        return $this->jsonMensaje(200,$titulo,$mensaje,'success');
    }

    public function jsonMensajeError($titulo,$mensaje){
        return $this->jsonMensaje(422,$titulo,$mensaje,'error');

    }

}