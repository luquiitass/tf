<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;

use Carbon\Carbon;
use Dompdf\Exception;
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

    public function presencias(){
        return $this->hasMany(Presencia::class)->with('comensal');
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

    public function estados(){
        return $this->hasMany(Estado::class,'tabla','tabla')->orderBy('posicion');//Estado::where('tabla','instancias')->get();
    }

    public function instanciasEstado(){
        return $this->hasMany(InstanciaEstado::class);
    }

    public function instanciaEstadoActivo(){
        return $this->instanciaEstadoActivo = $this->instanciasEstado()->where('activo',1)->first();
    }


    /*Funciones */


    /*Metodos de Estados */

    public function crearNuevaInstanciaEstado(){
        return InstanciaEstado::crearEstado($this);
    }

    public function siguienteEstado(){
        return $this->instanciaEstadoActivo()->siguienteEstado($this);
    }

    public function generarPresencias(){

        if ($this->instanciaEstadoActivo()->estado->nombre == 'Abierta'){

            $comensales = $this->comida->comensales;

            foreach ($comensales as $comensal){
                $this->presencias()->create(['comensal_id'=>$comensal->id]);
            }

            $this->siguienteEstado();

        }else{
            throw new Exception('La planilla no se ecuentra abierta. La inscripciones ya han sido generadas');
        }
    }


    //Mutadores

    public function getTablaAttribute(){
        return 'instancias';
    }

 }