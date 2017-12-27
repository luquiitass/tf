<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 01/10/17
 * Time: 16:59
 */

namespace App\Helper;


trait Search
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

}