<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_asignatura')->constrained('asignaturas')->onDelete('cascade');
            $table->foreignId('id_docente')->constrained('docentes')->onDelete('cascade');
            $table->string('grupo', 10);
            $table->string('periodo', 20);
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};