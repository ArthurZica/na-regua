<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services'],
            'user_id' => ['required', 'exists:users'],
            'customer_id' => ['required', 'exists:customers'],
            'empresa_id' => ['required', 'exists:empresas'],
            'scheduled_at' => ['required', 'date'],
            'created_on' => ['required'],
            'created_by' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
