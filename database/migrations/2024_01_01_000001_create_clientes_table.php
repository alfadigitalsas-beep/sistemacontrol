<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('empresa');
            $table->enum('tipo', ['comprador', 'arrendatario', 'ambos'])->default('comprador');
            $table->text('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('pais')->default('Colombia');
            $table->text('notas')->nullable();
            $table->boolean('activo')->default(true);
            $table->date('fecha_registro');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
