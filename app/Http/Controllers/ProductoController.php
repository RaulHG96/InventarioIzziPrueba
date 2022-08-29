<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    /**
     * Método para el registro de productos a base de datos
     * @param  ProductoRequest $request [Información de formulario de registro]
     * @return String                   [String con formato json para el cliente]
     */
    public function registerProduct(ProductoRequest $request) {
        $jsonResult = array(
            'success' => true
        );

        try {
            $validator = $request->validator;
            $request->validator->after(function(&$validator) use ($request) {
                if(!is_numeric($request['precio'])) {
                    $validator->errors()->add('precio', 'El precio del producto debe ser de tipo numérico');
                }
            });

            if ($validator->fails()) {
                $jsonResult['error'] = $validator->errors()->all();
                $jsonResult['success'] = false;
            } else {
                DB::transaction(function () use($request) {
                    Producto::create([
                        'nombreProducto' => $request['nombre_producto'],
                        'descripcion' => $request['descripcion'],
                        'precio' => $request['precio'],
                        'fechaCompra' => $request['fecha_compra'],
                        'idCategoria' => $request['categoria'],
                        'idSucursal' => $request['sucursal'],
                        'idUsuario' => Auth::guard('usrInventario')->user()->id,
                    ]);
                });
            }
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }
        return response()->json($jsonResult);
    }

    public function showViewUpdate($id = 0) {
        return view('private.products.product-update', [
            'producto' => Producto::find($id),
            'isUpdate' => true
        ]);
    }

    public function getProduct(Request $request) {
        $validator  = \Validator::make($request->all(), [
            'id' => 'required|numeric',
        ], [
            'id.required' => 'El identificar del producto es requerido',
            'id.numeric' => 'El identificar del producto debe ser de tipo numérico',
        ]);

        $jsonResult = array(
            'success' => true
        );
        try {
            if ($validator->fails()) {
                $jsonResult['error'] = $validator->errors()->all();
                $jsonResult['success'] = false;
            } else {
                $jsonResult['data'] = Producto::select('estado', 'descripcion', 'idCategoria', 'idSucursal', 'nombreProducto', 'precio')
                    ->where('id', $request['id'])
                    ->first()
                    ->toArray();
            }
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }
        return response()->json($jsonResult);
    }

    public function getStatusProduct() {
        $jsonResult = array(
            'success' => true
        );

        try {
            $jsonResult['data'] = ObtenerEstadosProducto();
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }
        return response()->json($jsonResult);
    }
}
