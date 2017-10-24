<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComidaPorDia extends Model
{

    protected $table = "comidas_por_dia";

    protected $fillable = ['dia_id','tipo_comida_id'];

    public $timestamps = true;

    public function tipoComida(){
        return $this->belongsTo(TipoComida::class);
    }

    public function dia(){
        return $this->belongsTo(Dia::class);
    }

}
