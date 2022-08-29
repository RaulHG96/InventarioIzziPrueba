<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatCategoriaController;
use App\Http\Controllers\CatPerfilController;
use App\Http\Controllers\CatSucursalController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Rutas login/logout/registro
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('registrar-usuario', [UsuarioController::class, 'registerUser'])->name('registrar-usuario');

// Página login
Route::get('/', function () {
    return view('welcome');
})->name('login')->middleware('guest:usrInventario');

// Perfiles
Route::get('perfil', [CatPerfilController::class, 'getPermissions'])->name('perfil');

// Páginas de error
Route::get('/error/{codigo?}', function ($codigo) {
    return view('public.error-pages.error-page', ['codigoError' => $codigo]);
});

/////////////////////////////////////////////////////////////////////
// Se valida si el usuario está autenticado en el sistema
Route::group(['middleware' => ['auth:usrInventario']], function () {
    // Los perfiles son:
    // 1 para administrador
    // 2 para capturista
    Route::group(['middleware' => ['Role:1,2']], function() {
        // Obtención de catálogos para formulario de registro/actualización de productos
        Route::get('categorias', [CatCategoriaController::class, 'getCategories'])->name('categorias');
        Route::get('sucursales', [CatSucursalController::class, 'getBranches'])->name('sucursales');
        Route::get('estado', [ProductoController::class, 'getStatusProduct'])->name('estado');
    });

    Route::group(['middleware' => ['Role:1']], function(){
        // Registro/actualización de productos por ajax
        Route::post('actualizar-producto', [ProductoController::class, 'updateProduct'])->name('actualizar-producto');
        Route::get('info-producto', [ProductoController::class, 'getProduct'])->name('info-producto');
        // Obtener lista de productos
        Route::get('obtener-productos', [ProductoController::class, 'getListProducts'])->name('obtener-productos');
        // Eliminación de productos
        Route::post('eliminar-producto', [ProductoController::class, 'deleteProduct'])->name('eliminar-producto');
    });

    Route::group(['middleware' => ['Role:1,2']], function() {
        // Registro/actualización de productos por ajax
        Route::post('registrar-producto', [ProductoController::class, 'registerProduct'])->name('registrar-producto');
    });
    // Rutas de dashboard
    Route::prefix('dashboard')->group(function () {
        Route::group(['middleware' => ['Role:1,2']], function() {
            Route::get('/', function() {
                return view('private.dashboard');
            })->name('dashboard');
        });

        Route::group(['middleware' => ['Role:1']], function() {
            Route::get('lista-productos', function() {
                return view('private.products.list-product');
            })->name('lista-productos');

            Route::get('actualiza-producto/{id?}', [ProductoController::class, 'showViewUpdate'])->name('actualiza-producto');
        });

        Route::group(['middleware' => ['Role:2']], function() {
            Route::get('registro-productos', function() {
                return view('private.products.product-register');
            })->name('registro-productos');
        });

    });
});


Route::get('/usuario', [AuthController::class, 'index']);