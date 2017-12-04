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

   // protected $appends = ['estado'];

    protected $with = ['comida'];

    public function comida(){
        return $this->belongsTo(Comida::class);
    }

    public function presencias(){
        return $this->hasMany(Presencia::class);
    }

    public function allEstados(){
        return $this->allEstados = Estado::get();
    }

    public function estados(){
        return $this->belongsToMany(Estado::class,'instancia_estado')->withPivot(['activo'])->withTimestamps();
    }

    public function estadoActual(){
        return $this->estadoActivo =  $this->estados()->wherePivot('activo',1)->first();
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

    /*Funciones */

   public function crearEstadoInicial(){
       $cabecera = Cabecera::where('nombre','instancias_estados_1')->first();

       if (!$cabecera){
           $this->crearCabeceraEstadosCaminos();
       }

       $camino = $cabecera->caminoEstados()->where('inicio',1)->first();
       $estado = $camino->origen;
       /*Obtener el camino con inicio activo de cabecera*/

       /*asignar unas relacion al estado origen de la cabecera*/
       //$this->estadoActual()->pivot->activo = 0;
       //$this->estadoActual()->pivot->save();
       $this->estados()->attach($estado,['activo'=>1]);


       /*Devolver instancia*/

       return $this->load('estados');


   }


   public function siguienteEstado(){
       $cabecera = Cabecera::where('nombre','instancias_estados_1')->first();

       /*Obtener el estado actual*/

       /*buscar el siguiente estado en cabecera con origen del estado actual*/

       /*Crear la relacion con el elstado destino*/

       /*Debolver la instancoia*/
   }

   public function SuspenderInstancia(){
       /*Obtener el estado relacionado con los caminos de la instancia con el nombre de    "Suspendido"*/

       /*Crear la relacion entre la instancia y el comedor*/

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
 }
