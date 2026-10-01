<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\ProgramaAcademicoController;
use App\Http\Controllers\PensumController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TipoEvaluacionController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\BancoPreguntaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\RankingController;

Route::apiResource('roles', RolController::class);
Route::apiResource('personas', PersonaController::class);
Route::apiResource('docentes', DocenteController::class);
Route::apiResource('estudiantes', EstudianteController::class);
Route::apiResource('facultades', FacultadController::class);
Route::apiResource('programasacademicos', ProgramaAcademicoController::class);
Route::apiResource('pensum', PensumController::class);
Route::apiResource('asignaturas', AsignaturaController::class);
Route::apiResource('cursos', CursoController::class);
Route::apiResource('tipos_evaluacion', TipoEvaluacionController::class);
Route::apiResource('evaluaciones', EvaluacionController::class);
Route::apiResource('banco_preguntas', BancoPreguntaController::class);
Route::apiResource('notas', NotaController::class);
Route::apiResource('rankings', RankingController::class);