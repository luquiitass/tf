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

    protected $with = ['unidadDeMedida'];

     protected $casts = [
        'activo'=>'boolean'
     ];

    public function comedor(){
        return $this->belongsTo(Comedor::class);
    }

    public function unidadDeMedida(){
        return $this->belongsTo(UnidadDeMedida::class);
    }

    public function recetas(){
        return  $this->belongsToMany(Receta::class,'ingredientes');
    }


    public function scopeGetData($query){
        $comedor_id = request()->get('comedor_id');

        if ($comedor_id){
            $query
                //->join('unidades_de_medida','unidades_de_medida.id','=','insumos.unidad_de_medida_id')
                ->where('insumos.comedor_id',$comedor_id)
                //->select('insumos.*','unidades_de_medida.nombre as um')
                ->with('comedor','unidadDeMedida');
        }
        return  $this->scopeSearchPaginateAndOrder($query);
    }
 }
