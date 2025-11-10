<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Empresa;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppointmentService
{
    public function __construct()
    {
    }

    public function getAvailableSlots($date, $serviceId, $empresaId, $barberId = null): array
    {
        $service = Service::findOrFail($serviceId);
        $duration = $service->duration_minutes;
        $startTime = Carbon::parse("$date 08:00");
        $endTime = Carbon::parse("$date 23:00");
        $interval = 10;
        $now = Carbon::now();

        if ($now > $endTime) {
            return [];
        }
        if ($now > $startTime) {
            $startTime = $now->copy()->addMinutes($interval - ($now->minute % $interval))->second(0);
        }

        $period = CarbonPeriod::create($startTime, "{$interval} minutes", $endTime);

        $query = Appointment::query()
            ->where('empresa_id', $empresaId)
            ->whereDate('scheduled_at', $date);

        if ($barberId) {
            $query->where('user_id', $barberId);
        }

        $appointments = $query->get();

        $empresa = Empresa::where('id', $empresaId)->with('users')->firstOrFail();

        $allBarbers = $barberId ? collect([$barberId]) : $empresa->users->pluck('id');

        $bookedByBarber = [];
        foreach ($appointments as $appt) {
            $bookedByBarber[$appt->user_id][] = [
                'start' => Carbon::parse($appt->scheduled_at),
                'end'   => Carbon::parse($appt->end_at),
            ];
        }

        $available = [];

        foreach ($period as $slot) {
            $slotEnd = $slot->copy()->addMinutes($duration);
            if ($slotEnd->gt($endTime)) break;

            $freeCount = 0;

            foreach ($allBarbers as $barber) {
                $conflict = false;
                foreach ($bookedByBarber[$barber] ?? [] as $b) {
                    if (
                        $slot->between($b['start'], $b['end']->copy()->subMinute()) ||
                        $slotEnd->between($b['start']->copy()->addMinute(), $b['end']) ||
                        ($slot->lte($b['start']) && $slotEnd->gte($b['end']))
                    ) {
                        $conflict = true;
                        break;
                    }
                }
                if (!$conflict) {
                    $freeCount++;
                }
            }

            if (($barberId && $freeCount > 0) || (!$barberId && $freeCount > 0)) {
                $available[] = $slot->format('H:i');
            }
        }

        return $available;
    }

}
