<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComedorUpdateRequest extends Request
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
        $id = $this->route()->parameters()['comedor'];
        return [
            'nombre'=>'required|min:2|unique:comedores,nombre,' .$id . ',id',
            'administradores'=>'required',
        ];
    }
}
