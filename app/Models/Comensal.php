<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\Search;
use App\Helper\Tabla;
use Illuminate\Database\Eloquent\Model;

class Comensal extends Model
{
    use Tabla,Search,AjaxGetAttribute;

    protected $table = "comensales";

    protected $fillable = ['user_id','comedor_id'];

    protected $with = ['usuario'];


    public $timestamps = true;

    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comedor(){
        return $this->belongsTo(Comedor::class);
    }

    public function inscripciones(){
        return $this->belongsToMany(ComidaPorDia::class,'inscripciones','comensal_id','comidas_por_dia_id')->with('tipoComida');
    }

    public function scopeGetData($query,$idComedor){

        $query->join('comedores','comensales.comedor_id','=','comedores.id')
            ->where('comedores.id',$idComedor);
        $query->leftJoin('users','users.id','=','comensales.user_id');
        $query->select('users.*','comensales.*');
        return $this->scopeSearchPaginateAndOrder($query);
    }

}
