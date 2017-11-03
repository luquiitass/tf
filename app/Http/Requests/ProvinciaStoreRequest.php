<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProvinciaStoreRequest extends Request
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
        $idPais = $this->request->get('pais_id');
        return [
            'nombre' => 'required|min:3|unique:provincias,nombre,NULL,id,pais_id,' . $idPais,
        ];
    }
}
