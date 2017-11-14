<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Helper\DataViewer;
use App\Helper\Funciones;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Object_;

class Comedor extends Model
{
    use Tabla,Filtros,AjaxGetAttribute;

     protected $table = "comedores";

     protected $fillable = ['nombre','capacidad','activo'];


     protected $with = ['administradores'];

     public $timestamps = true;




     public function administradores(){
         return $this->belongsToMany(User::class);
     }

     public function comensales(){
         return $this->hasMany(Comensal::class);
     }


     public function comidas(){
         return $this->hasMany(Comida::class)->with('dia','tipoComida')->withCount('comensales');
     }

     public function tiposComidas(){
         return $this->hasMany(TipoComida::class)->with('comidasPorDia');
     }

     public function getActivoAttribute($data){
         return $data ? 'Activo':'Inactivo';
     }

     public function anuncios(){
         return $this->hasMany(Anuncio::class)->with('usuario');
     }

     public function anunciosActivos(){
         return $this->anuncios->where('activo',true);
     }

     public function comidasByTipoComida(){
         $retorno = /*array();
         $tipos = */$this->comidas->groupBy('tipoComida.nombre');
         /*foreach ($tipos as $tipo => $comidas) {
             $com = new Object_();
             $comida = $comidas->first();
             $com->nombre = $tipo;
             $com->id = $comida->id;
             $com->inicio = $comida->inicio;
             $com->fin = $comida->fin;

             $com->tipo_comida_id = $comida->tipo_comida_id;
             $com->comedor_id = $comida->comedor_id;

             $com->hora_pre_inscripcion = $comida->hora_pre_inscripcion;
             $com->dias =   array();
             $com->activo = $comida->activo;
             foreach ($comidas as $unaComida){
                 $com->dias[] = $unaComida->dia;
             }
             $retorno[$tipo] = $com;
         }*/
         return $retorno;
     }

     public function comidasByDia()
     {
         //$retorno = array();
         //$dias =  $this->comidas->groupBy('dia.nombre');
         return $this->comidas->groupBy('dia.nombre');
//         foreach ($dias as $dia => $comidas) {
//             $com = new Object_();
//             $comida = $comidas->first();
//             $com->nombre = $dia;
//             $com->id = $comida->id;
//             $com->inicio = $comida->inicio;
//             $com->fin = $comida->fin;
//
//             $com->hora_pre_inscripcion = $comida->hora_pre_inscripcion;
//             $com->tipos_comida =   array();
//             foreach ($comidas as $tipoComida){
//                 $com->tipos_comida[] = $tipoComida->tipoComida;
//             }
//             $retorno[$dia] = $com;
//         }
//        return $retorno;
//         return $dias;
     }

     public function crearInstanciasSemanal(){
         foreach ( $this->comidas as $comida){
             try {
                 if ($comida->activo){
                     $comida->crearInstancia();
                 }
             }catch (\Exception $e){
                //echo $e->getMessage();
                 //return;
             }
         }
     }

     public function instancias(){
         return Instancia::join('comidas','comidas.id','=','instancias.comida_id')
             ->join('comedores','comedores.id','=','comidas.comedor_id')
             ->where('comedores.id',$this->id)
             ->select('instancias.*')
             ->with('comida')
             ->get();
     }




 }
