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

            $retorno = $object->$attribute;

        }else if($object->existFunction($attribute)){

            $retorno = $object->$attribute();

        }
        return response()->json($retorno);

    }

    public function existFunction($name){
        return method_exists($this,$name);
    }

    public function existAttribute($name){
        try{
            $this->$name;
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

}