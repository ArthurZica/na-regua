<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentApiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'empresa_id' => ['required', 'exists:empresas,id'],
            'scheduled_at' => ['required', 'date'],
            'created_by' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
