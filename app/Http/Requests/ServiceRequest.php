<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required', 'integer'],
            'duration_minutes' => ['required', 'integer'],
            'empresa_id' => ['required', 'exists:empresas'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
