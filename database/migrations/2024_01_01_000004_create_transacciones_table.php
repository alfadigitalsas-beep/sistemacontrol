<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('licencia_id')->nullable()->constrained('licencias')->onDelete('set null');
            $table->enum('tipo', ['venta', 'alquiler', 'renovacion', 'reembolso'])->default('venta');
            $table->decimal('monto', 15, 2);
            $table->date('fecha');
            $table->enum('metodo_pago', ['tarjeta', 'transferencia', 'efectivo', 'otro'])->default('transferencia');
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
