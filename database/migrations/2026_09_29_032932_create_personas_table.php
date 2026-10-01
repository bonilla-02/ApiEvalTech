<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rol');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->integer('edad');
            $table->string('correo', 150)->unique();
            $table->string('documento', 20)->unique();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};