<?php

namespace App\Http\Controllers;

use App\Models\CatCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class CatCategoriaController extends Controller
{
    /**
     * Obtener catálogo de categorias
     * @return String [String en formato JSON con el catálogo de categorías]
     */
    public function getCategories() {
        $jsonResult = array(
            'success' => true
        );
        try {
            $resultados = CatCategoria::select('id', 'nombreCategoria')
                ->orderBy('nombreCategoria')
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
