<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CatSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catSucursal')->insert([
            [
                'nombreSucursal' => 'Cuernavaca',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombreSucursal' => 'Yautepec',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombreSucursal' => 'Cuautla',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombreSucursal' => 'Acapulco',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
