<?php

namespace App\Models;

use App\Services\AppointmentService;
use App\Services\ScheduleMessageService;
use Carbon\Carbon;
use Filament\Facades\Filament;
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
        static::creating(function (Appointment $appointment) {


            if(!$appointment->empresa_id){
                $appointment->empresa_id = \Filament\Facades\Filament::getTenant()->id;
            }
            if(auth() !== null){
                $appointment->created_by = auth()->id();
            }

            // Se service_id estiver preenchido, calcula end_at
            if ($appointment->service_id) {
                $service = \App\Models\Service::find($appointment->service_id);

                if ($service) {
                    $appointment->end_at = \Carbon\Carbon::parse($appointment->scheduled_at)
                        ->addMinutes($service->duration_minutes);
                }
            }
        });

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

    public function nomeEvento(){
        $serviceName = $this->service()->first()->name;
        $nomeCliente = $this->customer()->first()->name;

        return $serviceName.'-'.$nomeCliente;
    }
}
