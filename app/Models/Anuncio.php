<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Object_;

class Anuncio extends Model
{
    use Tabla,Filtros,AjaxGetAttribute;

     protected $table = "anuncios";

     protected $fillable = ['asunto','cuerpo','hasta','user_id','comedor_id'];


     protected $with = ['usuario'];

     public $timestamps = true;




     public function usuario(){
         return $this->belongsTo(User::class,'user_id');
     }

     public function comedor(){
         return $this->belongsTo(Comedor::class);
     }

 }
