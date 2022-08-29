<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ProductoIdRequest extends FormRequest
{
    public $validator;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric'
        ];
    }

    /**
     * Set messages
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => 'El identificar del producto es requerido',
            'id.numeric' => 'El identificar del producto debe ser de tipo numérico',
        ];
    }
    /**
     * Coloca el valor de validator de formrequest en la variable pública validator
     */
    protected function failedValidation(Validator $validator) {
        $this->validator = $validator;
    }
}
