<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{

    protected $table = "inscripciones";

    protected $fillable = ['comensal_id','comida_id','user_id','inscripto','descripcion','fecha'];

    public $timestamps = true;

    public function comida(){
        return $this->belongsTo(Comida::class)->with('dia','tipoComida');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }

}
