<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComidaPorDia extends Model
{

    protected $table = "comidas_por_dia";

    protected $fillable = ['dia','tipo_comida_id'];

    public $timestamps = true;

    public function TipoComida(){
        $this->belongsTo(TipoComida::class);
    }

}
