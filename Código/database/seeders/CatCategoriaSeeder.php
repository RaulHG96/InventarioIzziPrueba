<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CatCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catCategoria')->insert([
            [
                'nombreCategoria' => 'Electrónica',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombreCategoria' => 'Línea Blanca',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombreCategoria' => 'Deportes',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombreCategoria' => 'Alimentos',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombreCategoria' => 'Jardín',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
