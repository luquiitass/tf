<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComedorConfiguracion extends Model
{
    protected $table = 'comedor_configuraciones';

    protected $fillable = [];

    public $timestamps = false;

    public function comedor(){
        return $this->belongsTo(Comedor::class);
    }

}
