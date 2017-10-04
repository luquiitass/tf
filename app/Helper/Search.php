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
        $query_search = request()->get('query','columns');
        $columns = request()->get('columns');


        $query->orWhere('id', 'LIKE', '%'.$query_search.'%');
        $query->orWhere('nombre', 'LIKE', '%'.$query_search.'%');

    }

}