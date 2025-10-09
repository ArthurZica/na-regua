<?php

namespace App\Filament\Resources\Appointments\Pages;

use App\Filament\Resources\Appointments\AppointmentResource;
use App\Models\Service;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['empresa_id'] = Filament::getTenant()->id;
        $data['created_by'] = auth()->user()->id;

        $service = Service::find($data['service_id']);


        $data['begin_at'] = $data['scheduled_at'];
        $dataInicio = Carbon::parse($data['scheduled_at']);
        $data['end_at'] = $dataInicio->addMinutes($service->duration_minutes);

        return $data;
    }
}
