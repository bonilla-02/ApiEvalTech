<?php

namespace App\Http\Controllers;

use App\Models\Pensum;
use Illuminate\Http\Request;

class PensumController extends Controller
{
    /**
     * GET /api/pensum
     * Listar todos los pensum
     */
    public function index()
    {
        return response()->json(Pensum::all(), 200);
    }

    /**
     * POST /api/pensum
     * Crear un nuevo pensum
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_programa' => 'required|integer|exists:programas_academicos,id',
            'codigo'      => 'required|string|max:20|unique:pensum,codigo',
            'semestres'   => 'required|integer|min:1',
        ]);

        $pensum = Pensum::create($validatedData);

        return response()->json([
            'message' => 'Pensum creado exitosamente',
            'data'    => $pensum
        ], 201);
    }

    /**
     * GET /api/pensum/{id}
     * Obtener un pensum específico
     */
    public function show($id)
    {
        $pensum = Pensum::find($id);

        if (!$pensum) {
            return response()->json(['message' => 'Pensum no encontrado'], 404);
        }

        return response()->json($pensum, 200);
    }

    /**
     * PUT /api/pensum/{id}
     * Actualizar un pensum
     */
    public function update(Request $request, $id)
    {
        $pensum = Pensum::find($id);

        if (!$pensum) {
            return response()->json(['message' => 'Pensum no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'id_programa' => 'sometimes|integer|exists:programas_academicos,id',
            'codigo'      => 'sometimes|string|max:20|unique:pensum,codigo,' . $id,
            'semestres'   => 'sometimes|integer|min:1',
        ]);

        $pensum->update($validatedData);

        return response()->json([
            'message' => 'Pensum actualizado exitosamente',
            'data'    => $pensum
        ], 200);
    }

    /**
     * DELETE /api/pensum/{id}
     * Eliminar un pensum
     */
    public function destroy($id)
    {
        $pensum = Pensum::find($id);

        if (!$pensum) {
            return response()->json(['message' => 'Pensum no encontrado'], 404);
        }

        $pensum->delete();

        return response()->json(['message' => 'Pensum eliminado exitosamente'], 200);
    }
}