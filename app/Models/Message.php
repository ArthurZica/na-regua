<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'msg_id_wpp',
        'direction',
        'message',
        'instance_id',
        'phone_id_wpp',
        'status',
        'type',
        'media_url',
        'empresa_id',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
    public function instance(): BelongsTo
    {
        return $this->belongsTo(Instance::class);
    }
}
