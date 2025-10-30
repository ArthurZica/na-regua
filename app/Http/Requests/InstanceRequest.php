<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'instance_id' => ['nullable'],
            'name' => ['required'],
            'connected' => ['boolean'],
            'empresa_id' => ['required', 'exists:empresas'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
