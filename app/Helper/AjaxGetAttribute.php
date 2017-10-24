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

    public function ajaxGetAtribute($model){
        $attribute = request()->get('attribute');
        $retorno = '';

        if($model->existAttribute($attribute)) {

            $retorno = $model->$attribute;

        }else if($model->existFunction($attribute)){

            $retorno = $model->$attribute();

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