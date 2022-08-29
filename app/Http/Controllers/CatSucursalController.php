<?php

namespace App\Http\Controllers;

use App\Models\CatSucursal;
use Illuminate\Http\Request;

class CatSucursalController extends Controller
{
    /**
     * Obtener catálogo de sucursales
     * @return String [String en formato JSON con el catálogo de sucursales]
     */
    public function getBranches() {
        $jsonResult = array(
            'success' => true
        );
        try {
            $resultados = CatSucursal::select('id', 'nombreSucursal')
                ->orderBy('nombreSucursal')
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
