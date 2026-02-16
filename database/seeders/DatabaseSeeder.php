<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClienteSeeder::class,
            ProductoSeeder::class,
            LicenciaSeeder::class,
            TransaccionSeeder::class,
            RegistroUsoSeeder::class,
        ]);
    }
}
