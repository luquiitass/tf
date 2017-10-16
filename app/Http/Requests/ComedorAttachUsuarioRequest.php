<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\User;

class ComedorAttachUsuarioRequest extends Request
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
        $idComedor = $this->route()->parameters()['comedor'];
        return [
            'usuario'=>'required|unique:comedor_user,user_id,null,id,comedor_id,'.$idComedor,
        ];
    }

    public function messages()
    {   $usuario = User::find($this->request->get('usuario'));
        return [
            'usuario.unique' => 'Este usuario '. $usuario->apellido .' '. $usuario->nombre.' ya ha sido asociado',
        ];
    }
}
