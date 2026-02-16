<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->enum('categoria', ['ofimatica', 'diseno', 'desarrollo', 'seguridad', 'contabilidad', 'otro'])->default('otro');
            $table->string('version');
            $table->decimal('precio_compra', 15, 2);
            $table->decimal('precio_alquiler_mensual', 15, 2);
            $table->decimal('precio_alquiler_anual', 15, 2);
            $table->text('requisitos_sistema')->nullable();
            $table->boolean('activo')->default(true);
            $table->date('fecha_lanzamiento');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
