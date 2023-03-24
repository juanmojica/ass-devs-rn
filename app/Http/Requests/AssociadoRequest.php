<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociadoRequest extends FormRequest
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
        if ( $this->method() == 'PUT' ) {
            $validarEmail = 'required|email';

        } else {
            $validarEmail = 'required|email|unique:associados';
        }

        return [
            'nome' => 'required|max:255',
            'email' => $validarEmail,
            'cpf' => 'required|numeric',
            'data_filiacao' => 'required|date'
        ];
    }
}
