<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerByInstanceRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\Instance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Customer::class);

        return CustomerResource::collection(Customer::all());
    }

    public function store(CustomerRequest $request)
    {
        $this->authorize('create', Customer::class);

        return new CustomerResource(Customer::create($request->validated()));
    }

    public function show(Customer $customer)
    {
        $this->authorize('view', $customer);

        return new CustomerResource($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customer->update($request->validated());

        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        return response()->json();
    }

    public function createByInstance(CreateCustomerByInstanceRequest $request){
        $instance = Instance::where('instance_id', $request->instance)->first();
        $empresa = $instance->empresa_id;
        Customer::create([
            'empresa_id' => $empresa,
            'phone' => $request->phone,
            'name' => $request->name,
        ]);

        return response()->json(['usuário criado com sucesso!'],201);
    }
}
