<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserStoreRequest extends Request
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
        return [
            'nombre'=> 'required|min:3',
            'apellido'=> 'required|min:3',
            'fecha_nacimiento'=> 'required|date',
            'dni'=> 'required|unique:users,dni',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|min:4'
        ];
    }
}
