<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validaEmpresaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'empresa_id' => 'required|exists:empresas,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
