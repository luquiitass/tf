<?php

namespace App\Models;

use App\Helper\DataViewer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

 class ComedorUser extends Model
{
    use DataViewer;

     protected $table = "comedor_user";
     protected $fillable = ['user_id','comedor_id','creador'];

     public $timestamps = true;

 }
