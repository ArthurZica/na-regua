<?php

namespace App\Http\Resources;

use App\Models\ScheduledMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ScheduledMessage */
class ScheduledMessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'category' => $this->category,
            'text' => $this->text,
            'media_url' => $this->media_url,
            'scheduled_at' => $this->scheduled_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'customer_id' => $this->customer_id,
            'empresa_id' => $this->empresa_id,

            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'empresa' => new EmpresaResource($this->whenLoaded('empresa')),
        ];
    }
}
