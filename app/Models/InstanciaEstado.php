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

class InstanciaEstado extends Model
{
    use Tabla,AjaxGetAttribute;

     protected $table = "instancia_estado";

     protected $fillable = ['estado_id','instancia_id','activo'];

     public $timestamps = true;

    protected $with = ['estado'];

    public function instancia(){
        return $this->belongsTo(Instancia::class);
    }

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public static function crearEstado(Instancia $instancia){
        $minEstado = $instancia->estados()->min('posicion');

        $estado = $instancia->estados->where('posicion',$minEstado)->first();
        //dd($estado);

        $instanciaEstado = $instancia->instanciasEstado()->create(['estado_id' => $estado->id]);

        return $instanciaEstado->load('estado');
    }/*Crea una nueva InstanciaEstado asociado al primer estado de una istancia*/



    public function siguienteEstado(Instancia $instancia){
        //$instanciaEstado = $instancia->instanciaEstadoActivo();


        $this->activo = 0;

        $this->save();

        $posicionSiguienteEstado  =  $this->estado->posicion + 1;

        $estados = $instancia->estados;


        if ($estados->contains('posicion', $posicionSiguienteEstado)){


            $estado = $estados->whereLoose('posicion', $posicionSiguienteEstado)->first();

            //dd($estado);


            return $instancia->instanciasEstado()->create(['estado_id'=>$estado->id]);
        }
    } /*Finaliza este estado y verifica si existe un estado siguiente, de encontrarlo crea una nueva InstanciaEstado y lo asocia al estado*/


}
