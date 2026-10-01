<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * GET /api/docentes
     * Listar todos los docentes
     */
    public function index()
    {
        return response()->json(Docente::all(), 200);
    }

    /**
     * POST /api/docentes
     * Crear un nuevo docente
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_persona'       => 'required|integer|exists:personas,id',
            'titulo_academico' => 'nullable|string|max:100',
            'estado'           => 'boolean',
        ]);

        $docente = Docente::create($validatedData);

        return response()->json([
            'message' => 'Docente creado exitosamente',
            'data'    => $docente
        ], 201);
    }

    /**
     * GET /api/docentes/{id}
     * Obtener un docente específico
     */
    public function show($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return response()->json(['message' => 'Docente no encontrado'], 404);
        }

        return response()->json($docente, 200);
    }

    /**
     * PUT /api/docentes/{id}
     * Actualizar un docente
     */
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return response()->json(['message' => 'Docente no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'id_persona'       => 'sometimes|integer|exists:personas,id',
            'titulo_academico' => 'nullable|string|max:100',
            'estado'           => 'sometimes|boolean',
        ]);

        $docente->update($validatedData);

        return response()->json([
            'message' => 'Docente actualizado exitosamente',
            'data'    => $docente
        ], 200);
    }

    /**
     * DELETE /api/docentes/{id}
     * Eliminar un docente
     */
    public function destroy($id)
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return response()->json(['message' => 'Docente no encontrado'], 404);
        }

        $docente->delete();

        return response()->json(['message' => 'Docente eliminado exitosamente'], 200);
    }
}