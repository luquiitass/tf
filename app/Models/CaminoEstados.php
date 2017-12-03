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

class CaminoEstados extends Model
{
    use Tabla,AjaxGetAttribute;

     protected $table = "caminos_estados";

     protected $fillable = ['origrn','destino','inicio','cabecera_id'];

     public $timestamps = false;

    public function cabecera(){
        return $this->belongsTo(Cabecera::class);
    }

    public function origen(){
        return $this->belongsTo(Estado::class);
    }

    public function destino(){
        return $this->belongsTo(Estado::class);
    }

 }
