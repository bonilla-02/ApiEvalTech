<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pensum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa')->constrained('programas_academicos')->onDelete('cascade');
            $table->string('codigo', 20);
            $table->integer('semestres');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensum');
    }
};