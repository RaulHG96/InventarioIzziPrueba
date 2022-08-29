<?php

namespace App\Http\Requests;

use App\Models\CatPerfil;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
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
        $perfilesId = CatPerfil::select('id')->get()->toArray();
        $inArray = [];
        foreach ($perfilesId as $value) {
            array_push($inArray, $value['id']);
        }
        return [
            'nombre' => 'required|max:80',
            'apPaterno' => 'required|max:50',
            'apMaterno' => 'required|max:50',
            'nomUsuario' => 'required|min:8|max:30|unique:usuario,usuario',
            'permiso' => [
                'required',
                'numeric',
                Rule::in($inArray)
            ],
            'contrasenia' => 'required|min:8'
        ];
    }

    /**
     * Set messages
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required'       => 'El nombre es requerido',
            'nombre.max'            => 'El nombre debe tener menos de 80 caracteres',
            'apPaterno.required'    => 'El apellido paterno es requerido',
            'apPaterno.max'         => 'El apellido paterno debe tener menos de 50 caracteres',
            'apMaterno.required'    => 'El apellido materno es requerido',
            'apMaterno.max'         => 'El apellido materno debe tener menos de 50 caracteres',
            'nomUsuario.required'   => 'El nombre de usuario es requerido',
            'nomUsuario.min'        => 'El nombre de usuario debe tener mínimo 8 caracteres',
            'nomUsuario.max'        => 'El nombre de usuario debe tener menos de 30 caracteres',
            'nomUsuario.unique'     => 'El nombre de usuario ya existe registrado',
            'permiso.required'      => 'El tipo de permiso es requerido',
            'permiso.numeric'       => 'El identificador del permiso debe ser de tipo numérico',
            'permiso.in'            => 'El tipo de permiso no es válido',
            'contrasenia.required'  => 'La contraseña es requerida',
            'contrasenia.min'       => 'La contraseña debe tener mínimo 8 caracteres'
        ];
    }
    /**
     * Coloca el valor de validator de formrequest en la variable pública validator
     */
    protected function failedValidation(Validator $validator) {
        $this->validator = $validator;
    }
}
