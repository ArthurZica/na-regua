<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'appointment_id' => ['required', 'exists:appointments,id']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
