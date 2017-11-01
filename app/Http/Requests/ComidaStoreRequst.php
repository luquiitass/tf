<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComidaStoreRequst extends Request
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
            'tipo_comida_id'=>'required',
            'inicio'=>'required',
            'fin'=>'required',
            'hora_pre_inscripcion'=>'required',
            'dias'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'tipo_comida_id.required'=> 'Debe seleccionar un tipo de comida',
            'dias.required' => 'Debe seleccionar como minimo un dáa',
        ];
    }
}
