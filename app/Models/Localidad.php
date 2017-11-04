<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class Localidad extends Model
{
    use AjaxGetAttribute;

     protected $table = "localidades";

     protected $fillable = ['nombre','provincia_id'];

     public $timestamps = false;

     public function provincia(){
         return $this->belongsTo(Provincia::class);
     }



 }
