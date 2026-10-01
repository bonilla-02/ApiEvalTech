<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        return response()->json(Curso::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_asignatura' => 'required|integer|exists:asignaturas,id',
            'id_docente'    => 'required|integer|exists:docentes,id',
            'grupo'         => 'required|string|max:10',
            'periodo'       => 'required|string|max:20',
            'estado'        => 'boolean',
        ]);

        $curso = Curso::create($validatedData);

        return response()->json([
            'message' => 'Curso creado exitosamente',
            'data'    => $curso
        ], 201);
    }

    public function show($id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        return response()->json($curso, 200);
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'id_asignatura' => 'sometimes|integer|exists:asignaturas,id',
            'id_docente'    => 'sometimes|integer|exists:docentes,id',
            'grupo'         => 'sometimes|string|max:10',
            'periodo'       => 'sometimes|string|max:20',
            'estado'        => 'sometimes|boolean',
        ]);

        $curso->update($validatedData);

        return response()->json([
            'message' => 'Curso actualizado exitosamente',
            'data'    => $curso
        ], 200);
    }

    public function destroy($id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        $curso->delete();

        return response()->json(['message' => 'Curso eliminado exitosamente'], 200);
    }
}