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

class UnidadDeMedida extends Model
{
    use Tabla,AjaxGetAttribute;

     protected $table = "unidades_de_medida";

     protected $fillable = ['nombre','abreviatura','comedor_id'];

     public $timestamps = false;

    protected $casts = [
        'publico' => 'boolean',
    ];

    public function insumoda(){
        return $this->hasMany(Insumo::class);
    }

    public function comedor(){
        return $this->belongsTo(Comedor::class);
    }

 }
