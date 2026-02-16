<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->enum('tipo', ['compra', 'alquiler'])->default('compra');
            $table->enum('estado', ['activa', 'vencida', 'suspendida', 'pendiente'])->default('activa');
            $table->date('fecha_inicio');
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('cantidad_usuarios')->default(1);
            $table->string('clave_licencia')->unique();
            $table->decimal('precio_total', 15, 2);
            $table->boolean('renovacion_automatica')->default(false);
            $table->text('notas')->nullable();
            $table->date('fecha_creacion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('licencias');
    }
};
