<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CatPerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catPerfil')->insert([
            [
                'nombrePerfil' => 'Administrador',
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'nombrePerfil' => 'Capturista',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
