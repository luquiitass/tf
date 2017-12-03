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

class Ingrediente extends Model
{
    use Tabla,AjaxGetAttribute;

    protected $table = "ingredientes";

    protected $fillable = ['cantidad','primordial','descripciones','insumo_id','unidad_medida_id','receta_id'];

    public $timestamps = false;

    /*Relaciones*/

    public function insumo(){
        return $this->belongsTo(Insumo::class);
    }

    public function receta(){
        return $this->belongsTo(Receta::class);
    }

    public function unidadDeMedida(){
        return $this->belongsTo(UnidadDeMedida::class);
    }


 }
