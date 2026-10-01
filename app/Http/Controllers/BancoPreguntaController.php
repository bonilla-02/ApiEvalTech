<?php

namespace App\Http\Controllers;

use App\Models\BancoPregunta;
use Illuminate\Http\Request;

class BancoPreguntaController extends Controller
{
    /**
     * GET /api/banco_preguntas
     */
    public function index()
    {
        return response()->json(BancoPregunta::all(), 200);
    }

    /**
     * POST /api/banco_preguntas
     */
   public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_evaluacion' => 'required|integer|exists:evaluaciones,id',
        'enunciado'     => 'required|string',
        'tipo_pregunta' => 'required|string|max:50',
        'ponderacion'   => 'required|numeric|min:0',
    ]);

    $pregunta = BancoPregunta::create($validatedData);

    return response()->json([
        'message' => 'Pregunta agregada exitosamente al banco',
        'data'    => $pregunta
    ], 201);
}
    /**
     * GET /api/banco_preguntas/{id}
     */
    public function show($id)
    {
        $pregunta = BancoPregunta::find($id);

        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        return response()->json($pregunta, 200);
    }

    /**
     * PUT /api/banco_preguntas/{id}
     */
    public function update(Request $request, $id)
    {
        $pregunta = BancoPregunta::find($id);

        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'id_evaluacion' => 'sometimes|integer|exists:evaluaciones,id',
            'enunciado'     => 'sometimes|string',
            'tipo_pregunta' => 'sometimes|string|max:50',
            'ponderacion'   => 'sometimes|numeric|min:0',
        ]);

        $pregunta->update($validatedData);

        return response()->json([
            'message' => 'Pregunta actualizada exitosamente',
            'data'    => $pregunta
        ], 200);
    }

    /**
     * DELETE /api/banco_preguntas/{id}
     */
    public function destroy($id)
    {
        $pregunta = BancoPregunta::find($id);

        if (!$pregunta) {
            return response()->json(['message' => 'Pregunta no encontrada'], 404);
        }

        $pregunta->delete();

        return response()->json(['message' => 'Pregunta eliminada exitosamente'], 200);
    }
}