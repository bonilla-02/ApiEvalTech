<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programas_academicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_facultad')->constrained('facultades')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('codigo', 10)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programas_academicos');
    }
};