<?php

namespace App\Models;

use App\Helper\DataViewer;
use App\Helper\Search;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoleAndPermission,Tabla,Search;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','apellido','dni','fecha_nacimiento', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $columns = [
        'id'=>'Id', 'nombre'=>'Nombre', 'apellido'=>'Apellido',
        'dni'=>'DNI', 'email'=>'Email'
    ];


    public function comedores(){
        return $this->belongsToMany(Comedor::class);
    }

}
