<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class UsuarioUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameters()['usuario'];
        //dd($id);
        return [
            'nombre'=> 'required|min:3',
            'apellido'=> 'required|min:3',
            'fecha_nacimiento'=> 'required|date|before:' . Carbon::now()->format('d-M-Y') ,
            'dni'=> 'required|unique:users,dni,'.$id . ',id',
            'email'=> 'required|email|unique:users,email,'.$id .',id',
        ];
    }
}
