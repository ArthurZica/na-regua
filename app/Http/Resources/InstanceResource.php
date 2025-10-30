<?php

namespace App\Http\Resources;

use App\Models\Instance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Instance */
class InstanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'instance_id' => $this->instance_id,
            'name' => $this->nome,
            'connected' => $this->connected,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'empresa_id' => $this->empresa_id,

            'empresa' => new EmpresaResource($this->whenLoaded('empresa')),
        ];
    }
}
