<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class Direccion extends Model
{
    use AjaxGetAttribute;

     protected $table = "direcciones";

     protected $fillable = ['calle','altura','piso','dpto','localidad_id'];

     public $timestamps = false;

     public function localidad(){
         return $this->belongsTo(Localidad::class);
     }

 }
