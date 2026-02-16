<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaccion;

class TransaccionSeeder extends Seeder
{
    public function run(): void
    {
        $transacciones = [
            [
                'cliente_id' => 1,
                'licencia_id' => 1,
                'tipo' => 'venta',
                'monto' => 7475000,
                'fecha' => '2024-01-15',
                'metodo_pago' => 'transferencia',
                'descripcion' => 'Compra OfficeSuite Pro - 25 usuarios'
            ],
            [
                'cliente_id' => 2,
                'licencia_id' => 2,
                'tipo' => 'alquiler',
                'monto' => 570000,
                'fecha' => '2024-02-20',
                'metodo_pago' => 'tarjeta',
                'descripcion' => 'Alquiler anual DesignMaster Studio'
            ],
            [
                'cliente_id' => 3,
                'licencia_id' => 3,
                'tipo' => 'venta',
                'monto' => 9950000,
                'fecha' => '2024-03-10',
                'metodo_pago' => 'transferencia',
                'descripcion' => 'Compra SecurityShield Pro - 50 usuarios'
            ],
            [
                'cliente_id' => 4,
                'licencia_id' => 4,
                'tipo' => 'venta',
                'monto' => 12990000,
                'fecha' => '2024-04-05',
                'metodo_pago' => 'transferencia',
                'descripcion' => 'Compra ContaSoft ERP - 10 usuarios'
            ],
            [
                'cliente_id' => 5,
                'licencia_id' => 5,
                'tipo' => 'alquiler',
                'monto' => 195000,
                'fecha' => '2024-05-12',
                'metodo_pago' => 'tarjeta',
                'descripcion' => 'Alquiler semestral CodeIDE Enterprise'
            ],
            [
                'cliente_id' => 1,
                'licencia_id' => 6,
                'tipo' => 'alquiler',
                'monto' => 190000,
                'fecha' => '2024-06-01',
                'metodo_pago' => 'tarjeta',
                'descripcion' => 'Alquiler semestral DesignMaster Studio'
            ],
            [
                'cliente_id' => 2,
                'licencia_id' => 2,
                'tipo' => 'renovacion',
                'monto' => 570000,
                'fecha' => '2024-08-15',
                'metodo_pago' => 'tarjeta',
                'descripcion' => 'Renovación alquiler DesignMaster Studio'
            ]
        ];

        foreach ($transacciones as $transaccion) {
            Transaccion::create($transaccion);
        }
    }
}
