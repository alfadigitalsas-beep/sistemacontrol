<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registros_uso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('licencia_id')->constrained('licencias')->onDelete('cascade');
            $table->string('usuario_nombre');
            $table->string('usuario_email');
            $table->string('dispositivo')->nullable();
            $table->string('ip_address')->nullable();
            $table->dateTime('fecha_acceso');
            $table->enum('accion', ['activacion', 'desactivacion', 'login', 'logout', 'bloqueo'])->default('login');
            $table->enum('estado', ['activo', 'inactivo', 'bloqueado'])->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros_uso');
    }
};
