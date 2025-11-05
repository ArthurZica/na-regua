<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "phone" => "required",
            "text" => "required|String",
            "instance" => "required|exists:instances,instance_id",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
