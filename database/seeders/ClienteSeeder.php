<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nombre' => 'Juan Carlos Rodríguez',
                'email' => 'j.rodriguez@techcorp.com',
                'telefono' => '+57 300 123 4567',
                'empresa' => 'TechCorp Colombia',
                'tipo' => 'ambos',
                'direccion' => 'Calle 100 # 15-30',
                'ciudad' => 'Bogotá',
                'pais' => 'Colombia',
                'notas' => 'Cliente VIP, solicita descuentos corporativos',
                'activo' => true,
                'fecha_registro' => '2024-01-15'
            ],
            [
                'nombre' => 'María Fernanda López',
                'email' => 'm.lopez@creativa.co',
                'telefono' => '+57 310 987 6543',
                'empresa' => 'Creativa Digital',
                'tipo' => 'arrendatario',
                'ciudad' => 'Medellín',
                'pais' => 'Colombia',
                'activo' => true,
                'fecha_registro' => '2024-02-20'
            ],
            [
                'nombre' => 'Carlos Andrés Martínez',
                'email' => 'cmartinez@segurossa.com',
                'telefono' => '+57 320 456 7890',
                'empresa' => 'Seguros del Sur',
                'tipo' => 'comprador',
                'ciudad' => 'Cali',
                'pais' => 'Colombia',
                'activo' => true,
                'fecha_registro' => '2024-03-10'
            ],
            [
                'nombre' => 'Ana Patricia Gómez',
                'email' => 'agomez@educacion.gov.co',
                'telefono' => '+57 301 234 5678',
                'empresa' => 'Ministerio de Educación',
                'tipo' => 'comprador',
                'ciudad' => 'Bogotá',
                'pais' => 'Colombia',
                'activo' => true,
                'fecha_registro' => '2024-04-05'
            ],
            [
                'nombre' => 'Luis Eduardo Pérez',
                'email' => 'lperez@startup.io',
                'telefono' => '+57 315 876 5432',
                'empresa' => 'Startup Innovadora',
                'tipo' => 'arrendatario',
                'ciudad' => 'Barranquilla',
                'pais' => 'Colombia',
                'activo' => true,
                'fecha_registro' => '2024-05-12'
            ]
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
