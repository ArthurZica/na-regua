<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'msg_id_wpp' => ['nullable'],
            'direction' => ['required'],
            'message' => ['nullable'],
            'instance_id' => ['required', 'exists:instances,id'],
            'phone_id_wpp' => ['required'],
            'status' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'media_url' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
