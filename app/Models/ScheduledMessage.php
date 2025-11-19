<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduledMessage extends Model
{
    protected $fillable = [
        'type',
        'category',
        'text',
        'media_url',
        'customer_id',
        'scheduled_at',
        'empresa_id',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }


    protected function casts(): array
    {
        return [
            'scheduled_at' => 'timestamp',
        ];
    }
}
