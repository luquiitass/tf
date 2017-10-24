<?php

namespace App\Models;

use App\Helper\Tabla;
use Illuminate\Database\Eloquent\Model;

 class TipoComida extends Model
{
    use Tabla;

     protected $table = "tipos_comida";

     protected $fillable = ['nombre'];


     public $timestamps = false;

     public function comidasPorDia(){
         return $this->hasMany(ComidaPorDia::class);
     }

 }
