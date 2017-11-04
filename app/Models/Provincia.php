<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class Provincia extends Model
{
    use AjaxGetAttribute;

     protected $table = "provincias";

     protected $fillable = ['nombre','pais_id'];

     public $timestamps = false;

     public function pais(){
         return $this->belongsTo(Pais::class);
     }

     public function localidades(){
         return $this->hasMany(Localidad::class);
     }

 }
