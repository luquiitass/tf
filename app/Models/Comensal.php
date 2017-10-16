<?php

namespace App\Models;

use App\Helper\Search;
use App\Helper\Tabla;
use Illuminate\Database\Eloquent\Model;

class Comensal extends Model
{
    use Tabla,Search;

    protected $table = "comensales";

    protected $fillable = [];


    public $timestamps = true;

    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopeGetData($query){

        $query->leftJoin('users','users.id','=','comensales.user_id');
        //$query->whereNull('comensales.user_id');
        $query->select('users.*','comensales.*');
        //$query = User::query()->with('comensal');
        //$query = User::query()->has('comensal');

        return $this->scopeSearchPaginateAndOrder($query);
    }

}
