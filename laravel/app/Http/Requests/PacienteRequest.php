<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'data_nascimento' => 'required',
            'data_inclusao' => 'required',
            'cartao_sus' => 'required|max:255',
            'prontuario' => 'required|max:255',
            'diagnostico' => 'max:255',
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
            'nome.required' => 'O campo Nome precisa ser preenchido.',
            'nome.max' => 'O campo nome não deve exceder :max caracteres.',
            'data_nascimento.required' => 'O campo Data de Nascimento precisa ser preenchido.',
            'data_inclusao.required' => 'O campo Data de Inclusão precisa ser preenchido.',
            'cartao_sus.required' => 'O campo Cartão SUS precisa ser preenchido.',
            'cartao_sus.max' => 'O campo Cartão SUS não deve exceder :max caracteres.',
            'prontuario.required' => 'O campo Prontuário precisa ser preenchido.',
            'prontuario.max' => 'O campo prontuário não deve exceder :max caracteres.',
            'diagnostico.max' => 'O campo diagnóstico não deve exceder :max caracteres.',
        ];
    }
}
