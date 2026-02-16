<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistroUso;

class RegistroUsoSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            [
                'licencia_id' => 1,
                'usuario_nombre' => 'Juan Rodríguez',
                'usuario_email' => 'j.rodriguez@techcorp.com',
                'dispositivo' => 'PC-001',
                'ip_address' => '192.168.1.100',
                'fecha_acceso' => '2024-06-15 08:30:00',
                'accion' => 'login',
                'estado' => 'activo'
            ],
            [
                'licencia_id' => 2,
                'usuario_nombre' => 'María López',
                'usuario_email' => 'm.lopez@creativa.co',
                'dispositivo' => 'MacBook-Pro',
                'ip_address' => '192.168.1.101',
                'fecha_acceso' => '2024-06-15 09:15:00',
                'accion' => 'login',
                'estado' => 'activo'
            ],
            [
                'licencia_id' => 3,
                'usuario_nombre' => 'Carlos Martínez',
                'usuario_email' => 'cmartinez@segurossa.com',
                'dispositivo' => 'WS-045',
                'ip_address' => '192.168.1.102',
                'fecha_acceso' => '2024-06-14 16:45:00',
                'accion' => 'login',
                'estado' => 'activo'
            ],
            [
                'licencia_id' => 1,
                'usuario_nombre' => 'Ana García',
                'usuario_email' => 'a.garcia@techcorp.com',
                'dispositivo' => 'PC-012',
                'ip_address' => '192.168.1.103',
                'fecha_acceso' => '2024-06-15 10:00:00',
                'accion' => 'login',
                'estado' => 'activo'
            ],
            [
                'licencia_id' => 5,
                'usuario_nombre' => 'Luis Pérez',
                'usuario_email' => 'lperez@startup.io',
                'dispositivo' => 'Laptop-Dell',
                'ip_address' => '192.168.1.104',
                'fecha_acceso' => '2024-06-15 11:30:00',
                'accion' => 'login',
                'estado' => 'activo'
            ]
        ];

        foreach ($registros as $registro) {
            RegistroUso::create($registro);
        }
    }
}
