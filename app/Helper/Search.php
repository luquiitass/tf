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

    public function scopeSearch($query){
        $query_search = request()->get('query');
        $columns = request()->get('columns');
        $columns = str_replace("\"",'',$columns);
        $columns = explode(',',$columns);

        //dd($columns);
        foreach ($columns as $column){
            $query->orWhere($column, 'LIKE', '%'.$query_search.'%');
        }
    }

}