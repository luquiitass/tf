<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 20/10/17
 * Time: 01:50
 */

namespace App\Helper;


use App\Models\Instancia;

use App\Models\RetornoAjax;
use PhpParser\Builder\Class_;


trait AjaxGetAttribute
{
    public function ajaxGetAtribute($object){
        $attribute = request()->get('attribute');
        $retorno = '';

        if($object->existAttribute($attribute)) {
            \Log::info('Lucas ajax attribute',[$attribute]);
            $retorno = $object->$attribute;

        }else if($object->existFunction($attribute)){
            \Log::info('Lucas ajax funcion',[$attribute]);

            $retorno = $object->$attribute();

        }else{
            \Log::info('Lucas ajax Sentencia',[$attribute]);
            try{
                $retorno = $object->$attribute;
            }catch (\Exception $e){
                \Log::debug('Lucas debug Ajax Attribute -->>la sentencia =>' .$attribute ,[$e->getMessage()]);

            }
        }


        return response()->json($retorno);

    }

    public function existFunction($name){
        return method_exists($this,$name);
    }

    public function existAttribute($name){
        try{
            return $this->$name? true : false;
            //return true;
        }catch (\Exception $e){
            return false;
        }
    }


    public function runFunction($clase ,$id,$funcion){
        try {
            $clase = 'App\Models\\' . $clase;
            if (class_exists($clase)) {

                $objeto = $clase::find($id);

                if ($objeto) {

                    return $objeto->$funcion();

                } else {
                    echo 'no Existe ' . $clase . " con id --" . $id;
                }

            } else {
                echo 'no Existe clase';

            }
        }catch (\Exception $e){
            return response()->json(['Error',$e->getMessage()],422);
        }
    }

    public function getAtribute($clase ,$id,$attribute){
        try {
            $clase = 'App\Models\\' . $clase;
            if (class_exists($clase)) {

                $objeto = $clase::find($id);

                if ($objeto) {

                    return response()->json($objeto->$attribute);

                } else {
                    echo 'no Existe ' . $clase . " con id --" . $id;
                }

            } else {
                echo 'no Existe clase';

            }
        }catch (\Exception $e){
            \Log::error(['error',$e->getTraceAsString()]);
            return response()->json(['Error',$e->getMessage() . $e->getTraceAsString()],422);
        }
    }


    public function runMethodStatic($clase,$funcion){
        try {
            $clase = 'App\Models\\' . $clase;
            if (class_exists($clase)) {

                try{

                    return $clase::$funcion();

                }catch (\Exception $e){
                    return response()->json($e->getMessage());
                }
            } else {
                echo 'no Existe clase';

            }
        }catch (\Exception $e){
            return response()->json(['Error',$e->getMessage()],422);
        }
    }

}