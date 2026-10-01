<?php

namespace App\Http\Controllers;

use App\Models\TipoEvaluacion;
use Illuminate\Http\Request;

class TipoEvaluacionController extends Controller
{
    public function index()
    {
        return response()->json(TipoEvaluacion::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'estado'      => 'sometimes|boolean',
        ]);

        $tipoEvaluacion = TipoEvaluacion::create($validatedData);

        return response()->json([
            'message' => 'Tipo de evaluación creado exitosamente',
            'data'    => $tipoEvaluacion
        ], 201);
    }

    public function show($id)
    {
        $tipoEvaluacion = TipoEvaluacion::find($id);

        if (!$tipoEvaluacion) {
            return response()->json(['message' => 'Tipo de evaluación no encontrado'], 404);
        }

        return response()->json($tipoEvaluacion, 200);
    }

    public function update(Request $request, $id)
    {
        $tipoEvaluacion = TipoEvaluacion::find($id);

        if (!$tipoEvaluacion) {
            return response()->json(['message' => 'Tipo de evaluación no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre'      => 'sometimes|string|max:100',
            'descripcion' => 'nullable|string',
            'estado'      => 'sometimes|boolean',
        ]);

        $tipoEvaluacion->update($validatedData);

        return response()->json([
            'message' => 'Tipo de evaluación actualizado exitosamente',
            'data'    => $tipoEvaluacion
        ], 200);
    }

    public function destroy($id)
    {
        $tipoEvaluacion = TipoEvaluacion::find($id);

        if (!$tipoEvaluacion) {
            return response()->json(['message' => 'Tipo de evaluación no encontrado'], 404);
        }

        $tipoEvaluacion->delete();

        return response()->json(['message' => 'Tipo de evaluación eliminado exitosamente'], 200);
    }
}