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

class Estado extends Model
{
    use Tabla,AjaxGetAttribute;

     protected $table = "estados";

     protected $fillable = ['nombre','tabla','posicion'];

     public $timestamps = false;

 }
