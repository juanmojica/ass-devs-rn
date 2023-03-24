<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AnuidadeRequest extends FormRequest
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
        /* return [
            'ano' => 'required|integer|unique:anuidades',
            'valor' => 'required'
        ]; */
        $id = $this->route('anuidade') ? $this->route('anuidade')->id : null;

        return [
            'ano' => [
                'required',
                'integer',
                Rule::unique('anuidades')->where(function ($query) use ($id) {
                    $query->where('deleted_at', null);
                    if ($id) {
                        $query->where('id', '<>', $id);
                    }
                })
            ]
        ];
    }
}
