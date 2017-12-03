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
use phpDocumentor\Reflection\Types\Object_;

class Receta extends Model
{
    use Tabla,AjaxGetAttribute;

    protected $table = "recetas";

    protected $fillable = ['nombre','porciones','preparacion','comedor_id'];

    public $timestamps = false;

    /*Relaciones*/

    public function comedor(){
        return $this->belongsTo(Comedor::class);
    }

    public function ingredientes(){
        return $this->hasMany(Ingrediente::class)->with('insumo');
    }


    public function scopeGetData($query){

        $comedor_id = request()->get('comedor_id');
        $query->where('comedor_id',$comedor_id)
            ->with('ingredientes.insumo.unidadDeMedida');

        return $this->scopeSearchPaginateAndOrder($query);
    }

 }
