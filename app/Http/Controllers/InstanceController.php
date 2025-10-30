<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstanceRequest;
use App\Http\Resources\InstanceResource;
use App\Models\Instance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InstanceController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Instance::class);

        return InstanceResource::collection(Instance::all());
    }

    public function store(InstanceRequest $request)
    {
        $this->authorize('create', Instance::class);

        return new InstanceResource(Instance::create($request->validated()));
    }

    public function show(Instance $instance)
    {
        $this->authorize('view', $instance);

        return new InstanceResource($instance);
    }

    public function update(InstanceRequest $request, Instance $instance)
    {
        $this->authorize('update', $instance);

        $instance->update($request->validated());

        return new InstanceResource($instance);
    }

    public function destroy(Instance $instance)
    {
        $this->authorize('delete', $instance);

        $instance->delete();

        return response()->json();
    }
}
