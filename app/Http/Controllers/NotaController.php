<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    {
        return response()->json(Nota::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_evaluacion' => 'required|integer|exists:evaluaciones,id',
            'id_estudiante' => 'required|integer|exists:estudiantes,id',
            'nota'          => 'required|numeric|min:0|max:5',
            'observaciones' => 'nullable|string',
        ]);

        $nota = Nota::create($validatedData);

        return response()->json([
            'message' => 'Nota registrada exitosamente',
            'data'    => $nota
        ], 201);
    }

    public function show($id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        return response()->json($nota, 200);
    }

    public function update(Request $request, $id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'id_evaluacion' => 'sometimes|integer|exists:evaluaciones,id',
            'id_estudiante' => 'sometimes|integer|exists:estudiantes,id',
            'nota'          => 'sometimes|numeric|min:0|max:5',
            'observaciones' => 'nullable|string',
        ]);

        $nota->update($validatedData);

        return response()->json([
            'message' => 'Nota actualizada exitosamente',
            'data'    => $nota
        ], 200);
    }

    public function destroy($id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $nota->delete();

        return response()->json(['message' => 'Nota eliminada exitosamente'], 200);
    }
}