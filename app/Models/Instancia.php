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
        return $this->hasMany(Presencia::class);
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

    public function cabeceras(){
        $this->belongsToMany(Cabecera::class);
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


    //Mutadoress

    public function getTablaAttribute(){
        return 'instancias';
    }

 }
