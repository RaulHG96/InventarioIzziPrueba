<?php

namespace App\Http\Controllers;

use App\Models\CatPerfil;
use Illuminate\Http\Request;

class CatPerfilController extends Controller
{
    /**
     * Obtener catálogo de sucursales
     * @return String [String en formato JSON con el catálogo de sucursales]
     */
    public function getPermissions() {
        $jsonResult = array(
            'success' => true
        );
        try {
            $resultados = CatPerfil::select('id', 'nombrePerfil')
                ->get()
                ->toArray();
            // dd($resultados);
            $jsonResult['data'] = $resultados;
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }

        return response()->json($jsonResult);
    }
}
