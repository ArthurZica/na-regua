<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Service */
class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'duration_minutes' => $this->duration_minutes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'empresa_id' => $this->empresa_id,

            'empresa' => new EmpresaResource($this->whenLoaded('empresa')),
        ];
    }
}
