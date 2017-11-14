<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presencia extends Model
{

    protected $table = "presencias";

    protected $fillable = ['estado','hora','comensal_id','instancia_id'];

    public $timestamps = false;

}
