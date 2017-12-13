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

     protected $fillable = ['inicio','fin','hora_pre_inscripcion','comedor_id','dia_id','tipo_comida_id','activo'];

     public $timestamps = true;

     protected $appends = ['fecha'];

    protected $with = ['dia','tipoComida'];

    protected $casts = [
        'activo' => 'boolean'
    ];


     public function dia(){
         return $this->belongsTo(Dia::class);
     }

     public function tipoComida(){
         return $this->belongsTo(TipoComida::class);
     }

     public function comensales(){
         return $this->belongsToMany(Comensal::class)->with('usuario');
     }

     public function instancias(){
         return $this->hasMany(Instancia::class);
     }

     public function instancia(){
         return $this->hasOne(Instancia::class,'fecha','fecha');
     }

     public function getFechaAttribute(){
         $hoy = Carbon::now();
         $hoy->setTimeFromTimeString($this->inicio);

         $func = 'is' . $this->dia->name;
         return $hoy->$func() ? /*'Hoy'*/ $hoy : Carbon::parse('next ' . $this->dia->name)->setTimeFromTimeString($this->inicio);

         //return Date::parse('this sunday');
     }

     public function crearInstancia(){
         $fecha = $this->fecha;
         //$inicio = $this->inicio;
         //c$fecha->setTimeFromTimeString($inicio);

         //$fecha->setTime($inicio->hour,$inicio->minute,$inicio->second);

         $instancia =  $this->instancias()->create(['fecha'=> $fecha]);
         \Log::alert('Lucas creo una instanica',[$instancia]);

         $instancia->crearEstadoInicial();

         return $instancia;
     }


     /*Mutadores*/
     public function getComensalesCountAttribute(){
         return $this->comensales()->count();
     }


     public function getCierreInscripcionAttribute(){
        $fecha = $this->fecha;
         return $fecha->subHours($this->hora_pre_inscripcion);
     }

 }
