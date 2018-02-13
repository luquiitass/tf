<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 01/10/17
 * Time: 16:59
 */

namespace App\Helper;


trait Select2
{

    public function scopeSearch($query,$filtros = null){
        $query_search = request()->get('query');
        $columns = request()->get('columns');
        $columns = str_replace("\"",'',$columns);
        $columns = explode(',',$columns);

        if ($filtros){
            foreach ($filtros as $attribute => $value){
                $query->where($attribute,$value);
            }
        }

        //dd($columns);
        foreach ($columns as $column){
            if ($filtros){
                $query->where(function ($que) use ($column,$query_search){
                    $que->orWhere($column, 'LIKE', '%'.$query_search.'%');

                });
            }else{
                $query->orWhere($column, 'LIKE', '%'.$query_search.'%');
            }
        }
    }

    public function getSelect($clase){
        try {
            $clase = 'App\Models\\' . $clase;
            if (class_exists($clase)) {
                try{

                    if (request()->has('column') && request()->has('query')){

                        $query = request()->get('query');
                        $column = request()->get('column');

                        $retorno =  $clase::eorWhere($column, 'LIKE', '%'.$query.'%')->get();

                        return $retorno->count() > 0 ? $retorno : 'Sin Registros';
                    }

                    $retorno = $clase::get();

                    return $retorno->count() > 0 ? $retorno : 'Sin Registros';

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