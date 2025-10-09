<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required'],
            'cnpj' => ['nullable'],
            'endereco' => ['nullable'],
            'telefone' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
