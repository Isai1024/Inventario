<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Papa',
                'categoria_id' => 1, 
                'precio_venta' => 10.00,
                'precio_compra' => 25.00,
                'fecha_compra' => '2024-07-13',
                'color' => 'cafe',
                'descripcion_corta' => 'papa',
                'descripcion_larga' => 'pues es una papa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Zanahoria',
                'categoria_id' => 1, 
                'precio_venta' => 12.00,
                'precio_compra' => 20.00,
                'fecha_compra' => '2024-07-13',
                'color' => 'naranja',
                'descripcion_corta' => 'zanahoria',
                'descripcion_larga' => 'pues es una zanahoria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Uva',
                'categoria_id' => 1,
                'precio_venta' => 5.00,
                'precio_compra' => 10.00,
                'fecha_compra' => '2024-07-13',
                'color' => 'verde',
                'descripcion_corta' => 'uva',
                'descripcion_larga' => 'pues es una uva',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
