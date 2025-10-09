<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Service::class);

        return ServiceResource::collection(Service::all());
    }

    public function store(ServiceRequest $request)
    {
        $this->authorize('create', Service::class);

        return new ServiceResource(Service::create($request->validated()));
    }

    public function show(Service $service)
    {
        $this->authorize('view', $service);

        return new ServiceResource($service);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $this->authorize('update', $service);

        $service->update($request->validated());

        return new ServiceResource($service);
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        return response()->json();
    }
}
