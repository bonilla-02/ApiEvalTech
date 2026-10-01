<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ranking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estudiante')->constrained('estudiantes')->onDelete('cascade');
            $table->foreignId('id_curso')->constrained('cursos')->onDelete('cascade');
            $table->decimal('promedio', 4, 2);
            $table->integer('posicion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ranking');
    }
};