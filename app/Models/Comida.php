<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Comida extends Model
{
    use Tabla, Filtros, AjaxGetAttribute;

     protected $table = "comidas";

     protected $fillable = ['inicio','fin','hora_pre_inscripcion','comedor_id','dia_id','tipo_comida_id'];

     public $timestamps = true;

     protected $appends = ['fecha'];

     public function dia(){
         return $this->belongsTo(Dia::class);
     }

     public function tipoComida(){
         return $this->belongsTo(TipoComida::class);
     }

     public function comensales(){
         return $this->belongsToMany(Comensal::class);
     }

     public function getFechaAttribute(){
         $hoy = Carbon::now();
         $func = 'is' . $this->dia->name;
         return $hoy->$func() ? 'Hoy' : Carbon::parse('next ' . $this->dia->name);

         //return Date::parse('this sunday');
     }



 }
