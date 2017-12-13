<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presencia extends Model
{

    protected $table = "presencias";

    protected $fillable = ['estado','hora','comensal_id','instancia_id'];

    public $timestamps = false;

    public function comensal(){
        return $this->belongsTo(Comensal::class)->with('usuario');
    }

    public function instancia(){
        return $this->belongsTo(Instancia::class);
    }

}
