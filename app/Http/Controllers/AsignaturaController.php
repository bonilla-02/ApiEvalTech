<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function index()
    {
        return response()->json(Asignatura::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pensum' => 'required|exists:pensum,id',
            'nombre' => 'required|string|max:100',
            'codigo' => 'required|string|max:20|unique:asignaturas,codigo',
            'creditos' => 'required|integer|min:1',
        ]);

        $asignatura = Asignatura::create($validatedData);

        return response()->json([
            'message' => 'Asignatura creada exitosamente',
            'data' => $asignatura
        ], 201);
    }
}