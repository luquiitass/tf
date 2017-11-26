<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsumoStoreRequest extends Request
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
        $idComedor = $this->request->get('comedor_id');
        return [
            'nombre'=>'required|unique:insumos,nombre,NULL,id,comedor_id,' . $idComedor,
            'unidad_de_medida_id'=>'required',
            'minimo'=>'required',
            'comedor_id'=>'required',
            'disponibilidad'=>'required',
        ];
    }
}
