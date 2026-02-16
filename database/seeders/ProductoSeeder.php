<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'OfficeSuite Pro',
                'descripcion' => 'Suite ofimática completa con procesador de texto, hojas de cálculo y presentaciones',
                'categoria' => 'ofimatica',
                'version' => '2024.1',
                'precio_compra' => 299000,
                'precio_alquiler_mensual' => 35000,
                'precio_alquiler_anual' => 350000,
                'requisitos_sistema' => 'Windows 10+, 4GB RAM, 2GB espacio',
                'activo' => true,
                'fecha_lanzamiento' => '2024-01-01'
            ],
            [
                'nombre' => 'DesignMaster Studio',
                'descripcion' => 'Herramienta profesional de diseño gráfico y edición de imágenes',
                'categoria' => 'diseno',
                'version' => '3.5',
                'precio_compra' => 899000,
                'precio_alquiler_mensual' => 95000,
                'precio_alquiler_anual' => 950000,
                'requisitos_sistema' => 'Windows 10+, macOS 12+, 8GB RAM, GPU dedicada',
                'activo' => true,
                'fecha_lanzamiento' => '2024-02-15'
            ],
            [
                'nombre' => 'CodeIDE Enterprise',
                'descripcion' => 'Entorno de desarrollo integrado con soporte para múltiples lenguajes',
                'categoria' => 'desarrollo',
                'version' => '2024.2',
                'precio_compra' => 599000,
                'precio_alquiler_mensual' => 65000,
                'precio_alquiler_anual' => 650000,
                'requisitos_sistema' => 'Windows 10+, macOS 12+, Linux, 8GB RAM',
                'activo' => true,
                'fecha_lanzamiento' => '2024-03-01'
            ],
            [
                'nombre' => 'SecurityShield Pro',
                'descripcion' => 'Antivirus y protección contra malware empresarial',
                'categoria' => 'seguridad',
                'version' => '5.0',
                'precio_compra' => 199000,
                'precio_alquiler_mensual' => 25000,
                'precio_alquiler_anual' => 250000,
                'requisitos_sistema' => 'Windows 10+, 2GB RAM',
                'activo' => true,
                'fecha_lanzamiento' => '2024-01-20'
            ],
            [
                'nombre' => 'ContaSoft ERP',
                'descripcion' => 'Sistema integral de contabilidad y gestión empresarial',
                'categoria' => 'contabilidad',
                'version' => '12.3',
                'precio_compra' => 1299000,
                'precio_alquiler_mensual' => 145000,
                'precio_alquiler_anual' => 1450000,
                'requisitos_sistema' => 'Windows Server 2019+, SQL Server, 16GB RAM',
                'activo' => true,
                'fecha_lanzamiento' => '2024-04-10'
            ]
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
