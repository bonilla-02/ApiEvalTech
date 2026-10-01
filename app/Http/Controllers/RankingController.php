<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        return response()->json(Ranking::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_estudiante' => 'required|integer|exists:estudiantes,id',
            'id_curso'      => 'required|integer|exists:cursos,id',
            'promedio'      => 'required|numeric|min:0|max:5',
            'posicion'      => 'required|integer|min:1',
        ]);

        $ranking = Ranking::create($validatedData);

        return response()->json([
            'message' => 'Posición de ranking registrada exitosamente',
            'data'    => $ranking
        ], 201);
    }

    public function show($id)
    {
        $ranking = Ranking::find($id);

        if (!$ranking) {
            return response()->json(['message' => 'Registro de ranking no encontrado'], 404);
        }

        return response()->json($ranking, 200);
    }

    public function update(Request $request, $id)
    {
        $ranking = Ranking::find($id);

        if (!$ranking) {
            return response()->json(['message' => 'Registro de ranking no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'id_estudiante' => 'sometimes|integer|exists:estudiantes,id',
            'id_curso'      => 'sometimes|integer|exists:cursos,id',
            'promedio'      => 'sometimes|numeric|min:0|max:5',
            'posicion'      => 'sometimes|integer|min:1',
        ]);

        $ranking->update($validatedData);

        return response()->json([
            'message' => 'Ranking actualizado exitosamente',
            'data'    => $ranking
        ], 200);
    }

    public function destroy($id)
    {
        $ranking = Ranking::find($id);

        if (!$ranking) {
            return response()->json(['message' => 'Registro de ranking no encontrado'], 404);
        }

        $ranking->delete();

        return response()->json(['message' => 'Registro de ranking eliminado exitosamente'], 200);
    }
}