<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HorariosDisponiveisRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'date' => 'required',Rule::date()->format('Y-m-d'),
            'barber_id' => 'nullable|exists:users,id',
            'empresa_id' => 'required|exists:empresas,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
