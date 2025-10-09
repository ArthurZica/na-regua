<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Appointment */
class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'scheduled_at' => $this->scheduled_at,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'service_id' => $this->service_id,
            'user_id' => $this->user_id,
            'customer_id' => $this->customer_id,
            'empresa_id' => $this->empresa_id,

            'service' => new ServiceResource($this->whenLoaded('service')),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'empresa' => new EmpresaResource($this->whenLoaded('empresa')),
        ];
    }
}
