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

    public function comidas(){
        return $this->belongsToMany(Comida::class);
    }

    public function inscripciones(){
        return $this->hasMany(Inscripcion::class)->with('comida','usuario');
    }

    public function inscripcionesWithMes(){
        return $this->inscripciones()->select('inscripciones.*',\DB::raw("DATE_FORMAT(created_at, '%m-%Y') mes"))->orderBy('created_at','desc')->get();
    }

    public function scopeGetData($query,$idComedor){

        $query->join('comedores','comensales.comedor_id','=','comedores.id')
            ->where('comedores.id',$idComedor);
        $query->leftJoin('users','users.id','=','comensales.user_id');
        $query->select('users.*','comensales.*');
        //request()->columns-> = '';
        //$query->with('comedor','usuario')->where('comedor_id',$idComedor);
        return $this->scopeSearchPaginateAndOrder($query);
    }

}
