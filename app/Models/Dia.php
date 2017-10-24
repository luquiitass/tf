<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class Dia extends Model
{
    use AjaxGetAttribute;

     protected $table = "dias";

     protected $fillable = ['nombre'];

     public $timestamps = false;



 }
