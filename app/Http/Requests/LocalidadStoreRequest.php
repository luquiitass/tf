<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocalidadStoreRequest extends Request
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
        $provincia_id = $this->request->get('provincia_id');
        return [
            'nombre' => 'required|min:3|unique:localidades,nombre,NULL,id,provincia_id,' . $provincia_id,
        ];
    }
}
