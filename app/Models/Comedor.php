<?php

namespace App\Models;

use App\Helper\DataViewer;
use App\Http\Controllers\Auth\Filtros;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class Comedor extends Model
{
    use DataViewer,Filtros;

     protected $table = "comedores";
     protected $fillable = ['nombre','creado','activo'];
     protected $with =['administradores'];


     public $timestamps = true;


     public function administradores(){
         return $this->belongsToMany(User::class);
     }

     public static $columns=[
         'id'=>'Id',
         'nombre'=>'Nombre',
         'activo'=>'Estado',
     ];

     public function getActivoAttribute($data){
         return $data ? 'Activo':'Inactivo';
     }

 }
