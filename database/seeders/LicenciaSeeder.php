<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Licencia;

class LicenciaSeeder extends Seeder
{
    public function run(): void
    {
        $licencias = [
            [
                'cliente_id' => 1,
                'producto_id' => 1,
                'tipo' => 'compra',
                'estado' => 'activa',
                'fecha_inicio' => '2024-01-15',
                'fecha_vencimiento' => null,
                'cantidad_usuarios' => 25,
                'clave_licencia' => 'OSP-2024-1A2B3C4D5E',
                'precio_total' => 7475000,
                'renovacion_automatica' => false,
                'fecha_creacion' => '2024-01-15'
            ],
            [
                'cliente_id' => 2,
                'producto_id' => 2,
                'tipo' => 'alquiler',
                'estado' => 'activa',
                'fecha_inicio' => '2024-02-20',
                'fecha_vencimiento' => '2025-02-20',
                'cantidad_usuarios' => 5,
                'clave_licencia' => 'DMS-2024-ALQ-7F8G9H',
                'precio_total' => 570000,
                'renovacion_automatica' => true,
                'fecha_creacion' => '2024-02-20'
            ],
            [
                'cliente_id' => 3,
                'producto_id' => 4,
                'tipo' => 'compra',
                'estado' => 'activa',
                'fecha_inicio' => '2024-03-10',
                'fecha_vencimiento' => null,
                'cantidad_usuarios' => 50,
                'clave_licencia' => 'SSP-2024-5I6J7K8L9M',
                'precio_total' => 9950000,
                'renovacion_automatica' => false,
                'fecha_creacion' => '2024-03-10'
            ],
            [
                'cliente_id' => 4,
                'producto_id' => 5,
                'tipo' => 'compra',
                'estado' => 'activa',
                'fecha_inicio' => '2024-04-05',
                'fecha_vencimiento' => null,
                'cantidad_usuarios' => 10,
                'clave_licencia' => 'CSE-2024-0N1O2P3Q4R',
                'precio_total' => 12990000,
                'renovacion_automatica' => false,
                'fecha_creacion' => '2024-04-05'
            ],
            [
                'cliente_id' => 5,
                'producto_id' => 3,
                'tipo' => 'alquiler',
                'estado' => 'activa',
                'fecha_inicio' => '2024-05-12',
                'fecha_vencimiento' => '2024-11-12',
                'cantidad_usuarios' => 3,
                'clave_licencia' => 'CIE-2024-ALQ-5S6T7U',
                'precio_total' => 195000,
                'renovacion_automatica' => false,
                'fecha_creacion' => '2024-05-12'
            ],
            [
                'cliente_id' => 1,
                'producto_id' => 2,
                'tipo' => 'alquiler',
                'estado' => 'activa',
                'fecha_inicio' => '2024-06-01',
                'fecha_vencimiento' => '2024-12-01',
                'cantidad_usuarios' => 2,
                'clave_licencia' => 'DMS-2024-ALQ-8V9W0X',
                'precio_total' => 190000,
                'renovacion_automatica' => true,
                'fecha_creacion' => '2024-06-01'
            ]
        ];

        foreach ($licencias as $licencia) {
            Licencia::create($licencia);
        }
    }
}
