<?php

namespace App\Helper;
use phpDocumentor\Reflection\Types\Self_;
use Validator;
use Barryvdh\DomPDF\PDF as PDF;

trait Tabla {

    protected $operators = [
        'equal' => '=',
        'not_equal' => '<>',
        'less_than' => '<',
        'greater_than' => '>',
        'less_than_or_equal_to' => '<=',
        'greater_than_or_equal_to' => '>=',
        'in' => 'IN',
        'like' => 'LIKE',
        'search' => 'search'
    ];

    public function scopeSearchPaginateAndOrder($query)
    {

        $requestArray = request()->get('query');

        $request = (object) $requestArray;

        $columns = request()->get('columns');


        $columns = collect($columns)->keys()->implode(',');


        $v = Validator::make($requestArray, [
            'column' => 'required|in:'.$columns,
            'direction' => 'required|in:asc,desc',
            'per_page' => 'integer|min:1',
            'search_column' => 'required|in:'.$columns,
            'search_operator' => 'required|alpha_dash|in:'.implode(',', array_keys($this->operators)),
            'search_input' => 'max:255'
        ]);


        if($v->fails()) {
            dd($v->messages());
            throw new \Illuminate\Validation\ValidationException($v);
        }



        $retorno = $query
            ->orderBy($request->column, $request->direction)
            ->where(function($query) use ($requestArray,$request,$columns) {
                if($request->search_input != '') {
                    if($request->search_operator == 'in') {
                        $query->whereIn($request->search_column, explode(',', $request->search_input));
                    }
                    else if($request->search_operator == 'like') {
                        $query->where($request->search_column, 'LIKE', '%'.$request->search_input.'%');
                    }
                    else if($request->search_operator == 'search') {
                        foreach (explode(',',$columns) as $column){
                            $query->orWhere($column, 'LIKE', "%$request->search_input%");
                        }

                    }
                     else {
                        $query->where($request->search_column, $this->operators[$request->search_operator], $request->search_input);
                    }
                }
            })
            ->paginate($request->per_page);


        $operation = request()->get('operation');

        if ($operation == 'pdf'){
            $items = response()->json($retorno)->getData('data')['data'];
            $columns = explode(',',$columns);
            return $this->getPDF($columns,$items);
        }

        return response()
            ->json([
                'model' => $retorno,
            ]);
    }

    public function getPDF($columns,$items){
        $pdf = \PDF::loadView('reporte',['columns'=>$columns,'items'=>$items]);

        return $pdf->stream();
    }

}