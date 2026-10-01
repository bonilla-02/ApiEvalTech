<?php

namespace App\Http\Controllers;

use App\Models\ProgramaAcademico;
use Illuminate\Http\Request;

class ProgramaAcademicoController extends Controller
{
    public function index()
    {
        return response()->json(ProgramaAcademico::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_facultad' => 'required|integer',
            'nombre'      => 'required|string|max:150',
            'codigo'      => 'required|string|max:20',
            'estado'      => 'nullable|boolean',
        ]);

        $programa = ProgramaAcademico::create($validated);

        return response()->json(['message' => 'Programa académico creado exitosamente', 'data' => $programa], 201);
    }

    public function show($id)
    {
        $programa = ProgramaAcademico::find($id);
        if (!$programa) return response()->json(['message' => 'Programa académico no encontrado'], 404);
        return response()->json($programa, 200);
    }

    public function update(Request $request, $id)
    {
        $programa = ProgramaAcademico::find($id);
        if (!$programa) return response()->json(['message' => 'Programa académico no encontrado'], 404);

        $validated = $request->validate([
            'id_facultad' => 'sometimes|required|integer',
            'nombre'      => 'sometimes|required|string|max:150',
            'codigo'      => 'sometimes|required|string|max:20',
            'estado'      => 'nullable|boolean',
        ]);

        $programa->update($validated);
        return response()->json(['message' => 'Programa académico actualizado exitosamente', 'data' => $programa], 200);
    }

    public function destroy($id)
    {
        $programa = ProgramaAcademico::find($id);
        if (!$programa) return response()->json(['message' => 'Programa académico no encontrado'], 404);

        $programa->delete();
        return response()->json(['message' => 'Programa académico eliminado correctamente'], 200);
    }
}