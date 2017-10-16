<?php

namespace App\Models;

use App\Helper\Tabla;
use Illuminate\Database\Eloquent\Model;

 class TipoComida extends Model
{
    use Tabla;

     protected $table = "tipos_comida";
     protected $fillable = ['nombre','inicio','fin','comedor_id'];

     protected $with =['comidasPorDia'];

     public $timestamps = false;

     public function comidasPorDia(){
         return $this->hasMany(ComidaPorDia::class,'tipo_comida_id');
     }

 }
