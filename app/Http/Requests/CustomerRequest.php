<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'name' => ['required'],
            'phone' => ['required'],
            'empresa_id' => ['required', 'exists:empresas'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
