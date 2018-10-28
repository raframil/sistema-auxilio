<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'cpf' => 'required|min:11|max:11',
            'funcao' => 'required'
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
            'nome.required' => 'O campo nome precisa ser preenchido.',
            'nome.max' => 'O campo nome não deve exceder :max caracteres.',
            'cpf.required' => 'O campo CPF precisa ser preenchido.',
            'cpf.max' => 'O campo CPF não deve exceder :max caracteres.',
            'funcao.required' => 'O campo função precisa ser selecionado.',
        ];
    }
}
