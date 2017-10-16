<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TipoComidaStoreRequest extends Request
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
        $comedor_id = $this->request->get('comedor_id');
        //dd($comedor_id);
        return [
            'nombre'=>'required|unique:tipos_comida,nombre,null,id,comedor_id,'.$comedor_id,
            'inicio'=>'required',
            'fin'=>'required',
            'comedor_id'=>'required'
        ];
    }
}
