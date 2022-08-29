<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductoRequest extends FormRequest
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
            'nombre_producto' => 'required_if:isUpdate,0|max:30',
            'precio' => 'required_if:isUpdate,0|max:5',
            'fecha_compra' => 'required_if:isUpdate,0|date',
            'categoria' => 'required_if:isUpdate,0|numeric',
            'sucursal' => 'required_if:isUpdate,0|numeric',
            'estado' => [
                'required_if:isUpdate,1',
                Rule::in(['Abierto', 'Cerrado'])
            ],
            'descripcion' => 'required_if:isUpdate,0|max:100'
        ];
    }

    /**
     * Set messages
     * @return array
     */
    public function messages()
    {
        return [
            'nombre_producto.required_if' => 'El nombre del producto es requerido',
            'nombre_producto.max' => 'El tamaño máximo del nombre de producto es de 30 caracteres',
            'precio.required_if' => 'El precio del producto es requerido',
            'precio.max' => 'El tamaño máximo del precio del producto debe ser de 5 caracteres',
            'precio.numeric' => 'El precio del producto debe ser de tipo numérico',
            'fecha_compra.required_if' => 'La fecha de compra es requerida',
            'fecha_compra.date' => 'El formato de la fecha de compra no es válida',
            'categoria.required_if' => 'La categoría del producto es requerida',
            'categoria.numeric' => 'La categoría del producto no es correcta',
            'sucursal.required_if' => 'La sucursal del producto es requerida',
            'sucursal.numeric' => 'La sucursal del producto no es correcta',
            'estado.required_if' => 'El estado del producto es requerido',
            'estado.in' => 'El estado del producto no es correcto',
            'descripcion.required_if' => 'La descripción del producto es requerida',
            'descripcion.max' => 'El tamaño máximo de la descripción es de 100 caracteres'
        ];
    }
    /**
     * Coloca el valor de validator de formrequest en la variable pública validator
     */
    protected function failedValidation(Validator $validator) {
        $this->validator = $validator;
    }
}
