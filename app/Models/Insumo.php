<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\Search;
use App\Helper\Tabla;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use Tabla,AjaxGetAttribute,Search;

     protected $table = "insumos";

     protected $fillable = ['nombre','disponibilidad','minimo','unidad_de_medida_id','comedor_id'];

     public $timestamps = false;

    public function comedor(){
        return $this->belongsTo(Comedor::class);
    }

    public function unidadDeMedida(){
        return $this->belongsTo(UnidadDeMedida::class);
    }

 }
