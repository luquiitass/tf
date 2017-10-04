<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 02/10/17
 * Time: 00:26
 */

namespace App\Http\Controllers\Auth;


use phpDocumentor\Reflection\Types\Self_;

trait Filtros
{
    protected function getArrayableItems(array $values)
    {
        if(!in_array('created_at', $this->hidden)){
            $this->hidden[] = 'created_at';
            $this->hidden[] = 'updated_at';

            $this->append(['registrado']);
            $this->append(['actualizado']);
        }
        return parent::getArrayableItems($values);
    }


    public function getRegistradoAttribute(){
        return $this->attributes['created_at'];
    }

    public function getActualizadoAttribute(){
    return $this->attributes['updated_at'];

}

}