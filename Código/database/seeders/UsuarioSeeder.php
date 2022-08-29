<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario')->insert([
            [
                'nombre' => 'Raul',
                'apPaterno' => 'Hidalgo',
                'apMaterno' => 'Gaspar',
                'usuario' => 'raul.hidalgo',
                'contrasenia' => Hash::make('secret'),
                'idPerfil' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
