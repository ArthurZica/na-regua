<?php

namespace App\Models;

use App\Services\AppointmentService;
use App\Services\ScheduleMessageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'service_id',
        'user_id',
        'customer_id',
        'empresa_id',
        'scheduled_at',
        'created_by',
        'end_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::created(function ($appointment) {
            (new ScheduleMessageService())->createAppointmentConfirmationMessage($appointment);
        });
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
