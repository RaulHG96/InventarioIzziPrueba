<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoIdRequest;
use App\Http\Requests\ProductoRequest;
use App\Models\Comentario;
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
    /**
     * Actualizar información de prodcuto
     * @param  ProductoRequest $request [Info del producto a actualizar]
     * @return String                   [String en formato JSON con el estatus de actualización]
     */
    public function updateProduct(ProductoRequest $request) {
        $jsonResult = array(
            'success' => true
        );

        try {
            $validator = $request->validator;
            $request->validator->after(function(&$validator) use ($request) {
                if(!isset($request['idProducto'])) {
                    $validator->errors()->add('required', 'El identificar del producto es requerido');
                } else if(!is_numeric($request['idProducto'])) {
                    $validator->errors()->add('precio', 'El identicador debe ser de tipo numérico');
                }
            });

            if ($validator->fails()) {
                $jsonResult['error'] = $validator->errors()->all();
                $jsonResult['success'] = false;
            } else {
                DB::transaction(function () use($request) {
                    $isUpdated = Producto::where('id', $request['idProducto'])
                    ->update([
                        'estado' => $request['estado']
                    ]);
                    if(!$isUpdated) {
                        throw new Exception('Ocurrió un problema al actualizar producto');
                    } else {
                        // Se guardan los comentarios
                        Comentario::create([
                            'comentario' => $request['comentarios'],
                            'idProducto' => $request['idProducto']
                        ]);
                    }
                });
            }
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }
        return response()->json($jsonResult);
    }
    /**
     * Obtiene el listado de productos, paginados en la tabla de cliente
     * @param  Request $request [Datos para la paginación]
     * @return String           [String en formato JSON con la información para mostrar en la tabla]
     */
    public function getListProducts(Request $request) {
        $jsonResult = array(
            'success' => true
        );
        try {
            $productos = Producto::select('estado', 'descripcion', 'catCategoria.nombreCategoria', 'catSucursal.nombreSucursal', 'nombreProducto', 'precio', 'fechaCompra', 'producto.id')
                ->join('catCategoria', 'catCategoria.id', '=', 'producto.idCategoria')
                ->join('catSucursal', 'catSucursal.id', '=', 'producto.idSucursal')
                ->offset($request['offset'])
                ->limit($request['limit'])
                ->orderBy('id')
                ->get()
                ->toArray();

            $cantProducto = Producto::count();
            foreach ($productos as $key => $producto) {
                $productos[$key]['url'] = url('dashboard/actualiza-producto', $producto['id']);
            }
            $jsonResult['data'] = [
                'cantidad' => $cantProducto,
                'rows' => $productos
            ];
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['data'] = [];
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }
        return response()->json($jsonResult);
    }
    /**
     * Mostrar la vista de edición, se manda bandera para deshabilitar los campos que no serán editables
     * @param  integer $id [Identificador de producto]
     */
    public function showViewUpdate($id = 0) {
        return view('private.products.product-update', [
            'producto' => Producto::find($id),
            'isUpdate' => true
        ]);
    }
    /**
     * Obtener la información de cierto producto
     * @param  Request $request [Información con identificador del producto]
     * @return String           [string en formato json con la información del producto]
     */
    public function getProduct(ProductoIdRequest $request) {
        $jsonResult = array(
            'success' => true
        );
        try {
            $validator = $request->validator;
            if ($validator->fails()) {
                $jsonResult['error'] = $validator->errors()->all();
                $jsonResult['success'] = false;
            } else {
                $jsonResult['data'] = Producto::select('estado', 'descripcion', 'idCategoria', 'idSucursal', 'nombreProducto', 'precio', 'fechaCompra')
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
    /**
     * Obtener el catálogo de estados del producto
     * @return String [String en formato JSON con la información del catálogo]
     */
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
    /**
     * Eliminación de productos de la base de datos
     * @param  ProductoIdRequest $request [Información con el identificador de producto a borrar]
     * @return [type]                     [description]
     */
    public function deleteProduct(ProductoIdRequest $request) {
        $jsonResult = array(
            'success' => true
        );
        try {
            $validator = $request->validator;
            if ($validator->fails()) {
                $jsonResult['error'] = $validator->errors()->all();
                $jsonResult['success'] = false;
            } else {
                DB::transaction(function () use($request) {
                    Comentario::where('idProducto', '=', $request['id'])->delete();
                    Producto::find($request['id'])->delete();
                });
            }
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }
        return response()->json($jsonResult);
    }
}
