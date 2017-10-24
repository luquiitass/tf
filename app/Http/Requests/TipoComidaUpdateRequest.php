<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TipoComidaUpdateRequest extends Request
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
        $id = $this->route()->parameters()['tipoComida'];
        return [
            'nombre'=>'required|unique:tipos_comida,nombre,'.$id.',id',
        ];
    }
}
