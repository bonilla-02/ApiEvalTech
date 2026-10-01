<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index()
    {
        return response()->json(Evaluacion::all(), 200);
    }

 public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_curso'           => 'required|integer|exists:cursos,id',
        'id_tipo_evaluacion' => 'required|integer|exists:tipo_evaluacion,id', // <-- Cambiar 'tipos_evaluacion' por 'tipo_evaluacion'
        'titulo'             => 'required|string|max:150',
        'descripcion'        => 'nullable|string',
        'fecha_inicio'       => 'required|date',
        'fecha_fin'          => 'required|date|after_or_equal:fecha_inicio',
    ]);

    $evaluacion = Evaluacion::create($validatedData);

    return response()->json([
        'message' => 'Evaluación creada exitosamente',
        'data'    => $evaluacion
    ], 201);
}

    public function show($id)
    {
        $evaluacion = Evaluacion::find($id);

        if (!$evaluacion) {
            return response()->json(['message' => 'Evaluación no encontrada'], 404);
        }

        return response()->json($evaluacion, 200);
    }

    public function update(Request $request, $id)
    {
        $evaluacion = Evaluacion::find($id);

        if (!$evaluacion) {
            return response()->json(['message' => 'Evaluación no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'id_curso'           => 'sometimes|integer|exists:cursos,id',
            'id_tipo_evaluacion' => 'sometimes|integer|exists:tipos_evaluacion,id', // Corregido el nombre de la variable
            'titulo'             => 'sometimes|string|max:150',
            'descripcion'        => 'nullable|string',
            'fecha_inicio'       => 'sometimes|date',
            'fecha_fin'          => 'sometimes|date|after_or_equal:fecha_inicio',
        ]);

        $evaluacion->update($validatedData);

        return response()->json([
            'message' => 'Evaluación actualizada exitosamente',
            'data'    => $evaluacion
        ], 200);
    }

    public function destroy($id)
    {
        $evaluacion = Evaluacion::find($id);

        if (!$evaluacion) {
            return response()->json(['message' => 'Evaluación no encontrada'], 404);
        }

        $evaluacion->delete();

        return response()->json(['message' => 'Evaluación eliminada exitosamente'], 200);
    }
}