<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    public function index()
    {
        return response()->json(Facultad::all(), 200);
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:100',
        'codigo' => 'required|string|max:10',
    ]);

    $facultad = new Facultad();
    $facultad->nombre = $request->input('nombre');
    $facultad->codigo = $request->input('codigo');
    $facultad->save();

    return response()->json([
        'message' => 'Facultad creada exitosamente',
        'data' => $facultad
    ], 201);
}

    public function show($id)
    {
        $facultad = Facultad::find($id);

        if (!$facultad) {
            return response()->json(['message' => 'Facultad no encontrada'], 404);
        }

        return response()->json($facultad, 200);
    }

    public function update(Request $request, $id)
    {
        $facultad = Facultad::find($id);

        if (!$facultad) {
            return response()->json(['message' => 'Facultad no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'codigo' => 'sometimes|required|string|max:10|unique:facultades,codigo,' . $id,
        ]);

        $facultad->update($validatedData);

        return response()->json([
            'message' => 'Facultad actualizada exitosamente',
            'data' => $facultad
        ], 200);
    }

    public function destroy($id)
    {
        $facultad = Facultad::find($id);

        if (!$facultad) {
            return response()->json(['message' => 'Facultad no encontrada'], 404);
        }

        $facultad->delete();

        return response()->json(['message' => 'Facultad eliminada exitosamente'], 200);
    }
}