<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Message */
class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'msg_id_wpp' => $this->msg_id_wpp,
            'direction' => $this->direction,
            'message' => $this->message,
            'phone_id_wpp' => $this->phone_id_wpp,
            'status' => $this->status,
            'type' => $this->type,
            'media_url' => $this->media_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'instance_id' => $this->instance_id,

            'instance' => new InstanceResource($this->whenLoaded('instance')),
        ];
    }
}
