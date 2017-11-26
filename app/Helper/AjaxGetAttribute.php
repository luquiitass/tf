<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 20/10/17
 * Time: 01:50
 */

namespace App\Helper;


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

}