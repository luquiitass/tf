<?php

namespace App\Models;

use App\Helper\DataViewer;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoleAndPermission,DataViewer;
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
        'id', 'nombre', 'apellido',
        'dni', 'email'
    ];

    public static $titles = [
        'Id', 'Nombre', 'Apellido',
        'DNI', 'Email'
    ];

}
