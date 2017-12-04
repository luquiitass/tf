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

class Cabecera extends Model
{
    use Tabla,AjaxGetAttribute;

    protected $table = "cabeceras";

    protected $fillable = ['nombre','tabla'];

    public $timestamps = false;


    public function instancias(){
     return $this->belongsToMany(Instancia::class);
    }

    public function caminoEstados(){
     return $this->hasOne(CaminoEstados::class);
    }



 }
