<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Instancia extends Model
{
    use Tabla,Filtros,AjaxGetAttribute;

     protected $table = "instancias";

     protected $fillable = ['fecha','comida_id'];

     public $timestamps = true;

    protected $appends = ['estado'];

    protected $with = ['comida'];

    public function comida(){
        return $this->belongsTo(Comida::class);
    }

    public function getEstadoAttribute(){
        $hoy = Carbon::now();
        $fecha = $this->fecha;

        if ($fecha > $hoy){
            return 'pendiente';
        }elseif ($fecha < $hoy){
            return 'pasado';
        }
    }

 }
