<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class Comedor extends Model
{
    use Tabla,Filtros,AjaxGetAttribute;

     protected $table = "comedores";

     protected $fillable = ['nombre','capacidad','activo'];


     //protected $appends = ['comidasPorDia'];

     public $timestamps = true;




     public function administradores(){
         return $this->belongsToMany(User::class);
     }

     public function comensales(){
         return $this->hasMany(Comensal::class);
     }

     public function comidasPorDia(){
        return $this->belongsToMany(ComidaPorDia::class)->withPivot(['inicio','fin','horas_pre_inscripcion'])->with('dia','tipoComida');
     }

     public function comidasByDia(){
         return $this->comidas =  ComidaPorDia::join('comedor_comida_por_dia as cc','comidas_por_dia.id','=','cc.comida_por_dia_id')
             ->join('comedores as co','cc.comedor_id','=','co.id')
             ->join('dias','comidas_por_dia.dia_id','=','dias.id')
             ->join('tipos_comida','comidas_por_dia.tipo_comida_id','=','tipos_comida.id')
             ->select('dias.nombre as dia','tipos_comida.nombre as tipo_comida','tipos_comida.id')
             ->get()
             ->groupBy('dia');
     }
     public function comidasByTipoComida(){
         return $this->comidas =  ComidaPorDia::join('comedor_comida_por_dia','comidas_por_dia.id','=','comedor_comida_por_dia.comida_por_dia_id')
             ->join('comedores','comedor_comida_por_dia.comedor_id','=','comedores.id')
             ->where('comedores.id',$this->id)
             ->join('dias','comidas_por_dia.dia_id','=','dias.id')
             ->join('tipos_comida','comidas_por_dia.tipo_comida_id','=','tipos_comida.id')
             ->select('comedor_comida_por_dia.*','dias.nombre as dia','tipos_comida.nombre as tipo_comida','tipos_comida.id')
             ->get()
             ->groupBy('tipo_comida');
     }

     public function otro(){
        return 'funcion otro';
     }



     public function comidasPorDiaCount(){
         return $this->comidasPorDiaCount = ComidaPorDia::join('tipos_comida','tipos_comida.id','=','comidas_por_dia.tipo_comida_id')
             ->join('comedores','comedores.id','=','tipos_comida.comedor_id')
             ->where('comedores.id',$this->id)
             //->orderBy('tipos_comida.inicio')
             ->select('comidas_por_dia.*')
             ->with('tipoComida')
             ->withCount('comensales')
             //->select()
             ->get()
             ->groupBy('dia');
     }

     public function tiposComidas(){
         return $this->hasMany(TipoComida::class)->with('comidasPorDia');
     }

     public function getActivoAttribute($data){
         return $data ? 'Activo':'Inactivo';
     }



 }
