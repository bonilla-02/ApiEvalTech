<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        return response()->json(Estudiante::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_persona' => 'required|exists:personas,id',
            'codigo_estudiantil' => 'required|string|max:20|unique:estudiantes,codigo_estudiantil',
            'estado' => 'nullable|boolean',
        ]);

        $estudiante = Estudiante::create($validatedData);

        return response()->json([
            'message' => 'Estudiante creado exitosamente',
            'data' => $estudiante
        ], 201);
    }
}