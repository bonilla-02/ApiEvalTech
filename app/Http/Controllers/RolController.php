<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        return response()->json(Rol::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:50|unique:roles,nombre',
            'descripcion' => 'nullable|string',
            'estado'      => 'nullable|boolean',
        ]);

        $rol = Rol::create($validated);

        return response()->json(['message' => 'Rol creado exitosamente', 'data' => $rol], 201);
    }

    public function show($id)
    {
        $rol = Rol::find($id);
        if (!$rol) return response()->json(['message' => 'Rol no encontrado'], 404);
        return response()->json($rol, 200);
    }

    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);
        if (!$rol) return response()->json(['message' => 'Rol no encontrado'], 404);

        $validated = $request->validate([
            'nombre'      => 'sometimes|required|string|max:50|unique:roles,nombre,' . $id . ',id_rol',
            'descripcion' => 'nullable|string',
            'estado'      => 'nullable|boolean',
        ]);

        $rol->update($validated);
        return response()->json(['message' => 'Rol actualizado exitosamente', 'data' => $rol], 200);
    }

    public function destroy($id)
    {
        $rol = Rol::find($id);
        if (!$rol) return response()->json(['message' => 'Rol no encontrado'], 404);

        $rol->delete();
        return response()->json(['message' => 'Rol eliminado correctamente'], 200);
    }
}