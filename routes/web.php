<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatCategoriaController;
use App\Http\Controllers\CatSucursalController;
use App\Http\Controllers\ProductoController;
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
// Rutas login/logout
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Página login
Route::get('/', function () {
    return view('welcome');
})->name('login')->middleware('guest:usrInventario');

/////////////////////////////////////////////////////////////////////
// Se valida si el usuario está autenticado en el sistema
Route::group(['middleware' => ['auth:usrInventario']], function () {
    // Obtención de catálogos para formulario de registro/actualización de productos
    Route::get('categorias', [CatCategoriaController::class, 'getCategories'])->name('categorias');
    Route::get('sucursales', [CatSucursalController::class, 'getBranches'])->name('sucursales');
    Route::get('estado', [ProductoController::class, 'getStatusProduct'])->name('estado');
    // Registro/actualización de productos
    Route::post('registrar-producto', [ProductoController::class, 'registerProduct'])->name('registrar-producto');
    Route::get('info-producto', [ProductoController::class, 'getProduct'])->name('info-producto');
    // Rutas de dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function() {
            return view('private.dashboard');
        })->name('dashboard');

        Route::get('lista-productos', function() {
            return view('private.products.list-product');
        })->name('lista-productos');

        Route::get('registro-productos', function() {
            return view('private.products.product-register');
        })->name('registro-productos');

        Route::get('actualiza-producto/{id?}', [ProductoController::class, 'showViewUpdate'])->name('actualiza-producto');
    });
});


Route::get('/usuario', [AuthController::class, 'index']);