<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class DoencaRequest extends FormRequest
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
            'nome' => 'required|min:1|max:100',
            'cid' => 'required|min:1|max:20'
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
            'cid.required' => 'O campo CID precisa ser preenchido.',
            'cid.max' => 'O campo CID não deve exceder :max caracteres.',
        ];
    }
}
