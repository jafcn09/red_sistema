<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rol_id' => [
                'required'
            ],
            'cedula' => [
                'required', 'max:15','min:3', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
            ],
            'nombres' => [
                'required', 'min:3'
            ],
            'apellidos' => [
                'required', 'min:3'
            ],
            'telefono' => [
                'required', 'min:3'
            ],
            'celular' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
            ],
            'password' => [
                $this->route()->user ? 'nullable' : 'required', 'confirmed', 'min:6'
            ],
            'calle_p' => [
                'required', 'min:3'
            ],
            'calle_s' => [
                'required', 'min:3'
            ],
            'direccion' => [
                'required', 'min:10'
            ],
            'salario' => [

            ],
            'descuento' => [
                
            ],
            'total_salario' => [
                
            ],
            'foto' => [
                'image'
            ],
            'foto_cedula' => [
                'image'
            ],
            'esta_activo' => [
                'required'
            ]
        ];
    }
}
