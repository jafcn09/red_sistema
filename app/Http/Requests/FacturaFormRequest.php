<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Factura;

class FacturaFormRequest extends FormRequest
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
        return [
            'tipo_comprobante' => 'required|max:20',
            'factura_num' => 'required|max:10',
            'total_venta' => 'required',

        ];
    }
}

