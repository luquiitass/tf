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

    protected $appends = ['fechaCierreInscripcion'];

     public $timestamps = true;

   // protected $appends = ['estado'];

    protected $with = ['comida'];

    public function comida(){
        return $this->belongsTo(Comida::class);
    }

    public function presencias(){
        return $this->hasMany(Presencia::class);
    }

    public function presentes(){
        return $this->hasMany(Presencia::class)->where('estado',1);
    }

    public function ausentes(){
        return $this->hasMany(Presencia::class)->where('estado',0);
    }

    public function allEstados(){
        return $this->allEstados = Estado::get();
    }

    public function estados(){
        return $this->belongsToMany(Estado::class,'instancia_estado')->withPivot(['activo'])->withTimestamps();
    }

    public function estadoActual(){
        return $this->estadoActivo =  $this->belongsToMany(Estado::class,'instancia_estado')->wherePivot('activo',1)->first();

    }

    public function InstanciaEstadoActual(){
        return $this->hasOne(InstanciaEstado::class)->where('activo',1)->with('estado');
    }

    public function cabeceraActual(){
        return Cabecera::where('nombre','instancias_estados_1')->first();
    }



   /* public function getEstadoAttribute(){
        $hoy = Carbon::now();
        $fecha = $this->fecha;

        if ($fecha > $hoy){
            return 'pendiente';
        }elseif ($fecha < $hoy){
            return 'pasado';
        }
    }*/

    public function cabeceras(){
        return $this->hasMany(Cabecera::class,'tabla','tabla');
    }


    /*mutadores*/

    public function getTablaAttribute(){
        return 'instancias';
    }

    public function getFechaCierreInscripcionAttribute(){
        return $this->comida->cierreInscripcion;
    }

    /*Funciones */

   public function crearEstadoInicial(){
       $cabecera = Cabecera::where('nombre','instancias_estados_1')->first();

       if (!$cabecera){
           $this->crearCabeceraEstadosCaminos();
           $cabecera = Cabecera::where('nombre','instancias_estados_1')->first();
       }

       $camino = $cabecera->caminoEstados()->where('inicio',1)->first();
       $estado = $camino->origen;
       /*Obtener el camino con inicio activo de cabecera*/

       /*asignar unas relacion al estado origen de la cabecera*/
       $this->estados()->attach($estado,['activo'=>1]);


       /*Devolver instancia*/

       return $this->load('estados');

   }


   public function cerrarInscripcion(){


       $estadoActual = $this->estadoActual();

       $estadoInscripcionCerrada = $this->allEstados()->where('nombre','Inscripcion cerrada')->first();
       /*Obtener el estado relacionado con los caminos de la instancia con el nombre de    "Suspendido"*/

       $this->crearPrsenciasComensales();
       /*crear predsencias */


       $estadoActual->pivot->activo = 0;
       $estadoActual->pivot->save();
       //Cancela ultimo estado activo

       $this->estados()->attach($estadoInscripcionCerrada->id);
       /*Crea la relacion con estado "Inscripcion abierta y lo coloca como estado activo*/
       $this->estadoActual();

       return $this->load('estados','presencias.comensal.usuario');
       /*Retornar la instancia*/
   }

   public function finalizarInstancia(){
       $estadoActual = $this->estadoActual();

       $estadoInscripcionFinalizada = $this->allEstados()->where('nombre','Finalizada')->first();
       /*Obtener el estado relacionado con los caminos de la instancia con el nombre de    "Suspendido"*/


       $estadoActual->pivot->activo = 0;
       $estadoActual->pivot->save();
       //Cancela ultimo estado activo

       $this->estados()->attach($estadoInscripcionFinalizada->id);
       /*Crea la relacion con estado "Inscripcion abierta y lo coloca como estado activo*/

       $this->estadoActual();

       return $this->load('estados','presentes.comensal.usuario','ausentes.comensal.usuario');
   }

   public function suspenderInstancia(){

       $estadoActual = $this->estadoActual();

       $estadoSuspendido = $this->allEstados()->where('nombre','Suspendida')->first();
       /*Obtener el estado relacionado con los caminos de la instancia con el nombre de    "Suspendido"*/

       $estadoActual->pivot->activo = 0;
       $estadoActual->pivot->save();
       //Cancela ultimo estado activo

       $this->estados()->attach($estadoSuspendido->id);
       /*Crea la relacion con estado suspendido y lo coloca como estado activo*/

       $this->estadoActual();

       return $this->load('estados');
       /*Retornar la instancia*/

   }




    public static function crearCabeceraEstadosCaminos()
    {
        $cabecera = Cabecera::create(['nombre'=>'instancias_estados_1','tabla'=>'instancias']);

        $estado1 = Estado::create(['nombre'=>'Inscripcion abierta']);
        $estado2 = Estado::create(['nombre'=>'Inscripcion cerrada']);
        $estado3 = Estado::create(['nombre'=>'Finalizada']);
        $estado4 = Estado::create(['nombre'=>'Suspendida']);

        $cabecera->caminoEstados()->create(['origen'=>$estado1->id,'destino'=>$estado2->id,'inicio'=>'1']);
        $cabecera->caminoEstados()->create(['origen'=>$estado2->id,'destino'=>$estado3->id,'inicio'=>'0']);
        $cabecera->caminoEstados()->create(['origen'=>$estado1->id,'destino'=>$estado4->id,'inicio'=>'0']);
        $cabecera->caminoEstados()->create(['origen'=>$estado2->id,'destino'=>$estado4->id,'inicio'=>'0']);
        $cabecera->caminoEstados()->create(['origen'=>$estado3->id,'destino'=>$estado4->id,'inicio'=>'0']);

    }


    /*Metodos de Estados */


    //Metodos al cambiar de estado a cierre de inscripcion
    public function crearPrsenciasComensales(){
        $comensales = $this->comida->comensales;
        
        foreach ($comensales as $comensal){
            $comensal->presencias()->create(['instancia_id'=>$this->id]);
        }
    }
 }
