<?php

namespace App\Models;

use App\Helper\DataViewer;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class Comedor extends Model
{
    use Tabla,Filtros;

     protected $table = "comedores";
     protected $fillable = ['nombre','capacidad','activo'];

     protected $with =['administradores'];


     public $timestamps = true;


     public function administradores(){
         return $this->belongsToMany(User::class);
     }

     public function getActivoAttribute($data){
         return $data ? 'Activo':'Inactivo';
     }

     public function tiposComidas(){
         return $this->hasMany(TipoComida::class);
     }
 }
