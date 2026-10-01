<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * GET /api/personas
     * Obtener todas las personas
     */
    public function index()
    {
        $personas = Persona::all();
        return response()->json($personas, 200);
    }

    /**
     * POST /api/personas
     * Crear una nueva persona
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_rol'    => 'required|integer',
        'nombre'    => 'required|string|max:100',
        'apellido'  => 'required|string|max:100',
        'edad'      => 'required|integer|min:0',
        'correo'    => 'required|email|max:150|unique:personas,correo',
        'documento' => 'required|string|max:20|unique:personas,documento',
        'estado'    => 'nullable|boolean',
    ]);

    // ✅ Usar el método create del Modelo Eloquent maneja automáticamente los timestamps
    $persona = Persona::create($validatedData);

    return response()->json([
        'message' => 'Persona creada exitosamente',
        'data'    => $persona
    ], 201);
}

    /**
     * GET /api/personas/{id}
     * Obtener una persona específica por ID
     */
    public function show($id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        return response()->json($persona, 200);
    }

    /**
     * PUT/PATCH /api/personas/{id}
     * Actualizar los datos de una persona
     */
    public function update(Request $request, $id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'id_rol'    => 'sometimes|required|integer',
            'nombre'    => 'sometimes|required|string|max:100',
            'apellido'  => 'sometimes|required|string|max:100',
            'edad'      => 'sometimes|required|integer|min:0',
            'correo'    => 'sometimes|required|email|max:150|unique:personas,correo,' . $id . ',id_persona',
            'documento' => 'sometimes|required|string|max:20|unique:personas,documento,' . $id . ',id_persona',
            'estado'    => 'nullable|boolean',
        ]);

        $persona->update($validatedData);

        return response()->json([
            'message' => 'Persona actualizada exitosamente',
            'data'    => $persona
        ], 200);
    }

    /**
     * DELETE /api/personas/{id}
     * Eliminar una persona
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        $persona->delete();

        return response()->json(['message' => 'Persona eliminada correctamente'], 200);
    }
}