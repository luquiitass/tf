<?php

namespace App\Models;

use App\Helper\AjaxGetAttribute;
use App\Models\Comensal;
use App\Helper\DataViewer;
use App\Helper\Foto;
use App\Helper\Search;
use App\Helper\Tabla;
use App\Http\Controllers\Auth\Filtros;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoleAndPermission,Tabla,Search,Foto,AjaxGetAttribute;
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

    protected $appends = ['foto'];

    public static $columns = [
        'id'=>'Id', 'nombre'=>'Nombre', 'apellido'=>'Apellido',
        'dni'=>'DNI', 'email'=>'Email'
    ];


    public function direccion(){
        return $this->belongsTo(Direccion::class)->with('localidad.provincia.pais');
    }


    public function comedores(){
        return $this->belongsToMany(Comedor::class);
    }

    public function comensal(){
        return $this->hasOne(Comensal::class);
    }

    public function setFoto($foto)
    {
        $this->guardarFoto($foto,'/img/','user_'. $this->id,'jpg');
    }

    public function getFotoAttribute($data){
        $url = 'img/user_'. $this->id . '.jpg';
        $random = '?'.str_random(5);
        if (file_exists($url)){
            return asset($url).$random;
        }
        return asset('img/user.png') .$random;
    }

    public function setPasswordAttribute($data){
        $this->attributes['password'] = bcrypt($data);
    }

}
