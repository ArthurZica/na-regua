<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduledMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required'],
            'category' => ['required'],
            'text' => ['nullable'],
            'media_url' => ['nullable'],
            'customer_id' => ['required', 'exists:customers'],
            'scheduled_at' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
