<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerByInstanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['nullable', 'email', 'max:254'],
            'name' => ['required'],
            'phone' => ['required'],
            'instance' => ['required', 'exists:instances,instance_id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
