<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pensum')->constrained('pensum')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('codigo', 20)->unique();
            $table->integer('creditos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};