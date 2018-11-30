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
            'funcao' => 'required',
            'telefone_principal' => 'required|max:45',
            'telefone_secundario' => 'max:45'
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
            'telefone_principal.required' => 'O campo Telefone Principal precisa ser preenchido.',
            'telefone_principal.max' => 'O campo Telefone Principal não deve exceder :max caracteres.',
            'telefone_secundario.max' => 'O campo Telefone Secundário não deve exceder :max caracteres.',
        ];
    }
}
