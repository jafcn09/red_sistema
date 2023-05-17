<?php

namespace App\Http\Requests;

use App\Enlace;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EnlaceRequest extends FormRequest
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
            'user_id' => [
                'required'
            ],
            'producto_id' => [
                'required'
            ],
            'router_id' => [
                'required'
            ],
            'nodo_id' => [
                'required'
            ],

            'ip' => [
                'required', 'max:18','min:9', Rule::unique((new Enlace)->getTable())->ignore($this->route()->enlace->id ?? null)
            ],

            'mac' => [
                'required', 'max:20','min:10', Rule::unique((new Enlace)->getTable())->ignore($this->route()->enlace->id ?? null)
            ],

            'corrdenadas' => [

            ],
            'activo' => [
                'required'
            ],
            'imagen' => [

            ]
        ];
    }
}
