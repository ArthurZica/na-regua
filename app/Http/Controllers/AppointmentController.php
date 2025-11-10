<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\HorariosDisponiveisRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Services\AppointmentService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AppointmentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Appointment::class);

        return AppointmentResource::collection(Appointment::all());
    }

    public function store(AppointmentRequest $request)
    {
        $this->authorize('create', Appointment::class);

        return new AppointmentResource(Appointment::create($request->validated()));
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return new AppointmentResource($appointment);
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $appointment->update($request->validated());

        return new AppointmentResource($appointment);
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return response()->json();
    }

    public function getAvailableSlots(HorariosDisponiveisRequest $request)
    {
        $appointmentService = new AppointmentService();
        $slots = $appointmentService->getAvailableSlots($request->date,$request->service_id,$request->empresa_id,$request->barber_id);
        return response()->json(['available_slots' => $slots]);
    }

}
