<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Http\Resources\EmpresaResource;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function index()
    {
        return EmpresaResource::collection(Empresa::all());
    }

    public function store(EmpresaRequest $request)
    {
        return new EmpresaResource(Empresa::create($request->validated()));
    }

    public function show(Empresa $empresa)
    {
        return new EmpresaResource($empresa);
    }

    public function update(EmpresaRequest $request, Empresa $empresa)
    {
        $empresa->update($request->validated());

        return new EmpresaResource($empresa);
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return response()->json();
    }
}
