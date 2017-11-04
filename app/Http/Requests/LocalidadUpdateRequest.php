<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocalidadUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameters()['localidad'];
        $idProvincia = $this->request->get('provincia_id');
        return [
            'nombre' => 'required|min:3|unique:localidades,nombre,'. $id .',id,provincia_id,' . $idProvincia,
        ];
    }
}
