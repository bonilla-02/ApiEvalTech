<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banco_preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_evaluacion')->constrained('evaluaciones')->onDelete('cascade');
            $table->text('enunciado');
            $table->string('tipo_pregunta', 50);
            $table->decimal('ponderacion', 5, 2)->default(1.00);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banco_preguntas');
    }
};