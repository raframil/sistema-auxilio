<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class VisitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|max:10',
            'hora' => 'required|max:5',
            'paciente_id' => 'required',
            'funcionario_id' => 'required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'data.required' => 'O campo data precisa ser preenchido.',
            'data.max' => 'O campo data não deve exceder :max caracteres.',
            'hora.required' => 'O campo hora precisa ser preenchido.',
            'hora.max' => 'O campo hora não deve exceder :max caracteres.',
            'paciente_id.required' => 'É preciso selecionar um paciente',
            'funcionario_id.required' => 'É preciso selecionar um funcionario'
        ];
    }
}
