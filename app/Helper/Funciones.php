<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 01/10/17
 * Time: 23:13
 */

namespace App\Helper;


use App\Models\Comedor;

Trait Funciones
{

    public static function getIds($list){
        $retorno = array();
        foreach ($list as $item){
            $retorno[] = $item['id'];
        }
        return $retorno;
    }


}