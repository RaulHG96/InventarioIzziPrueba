<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected function guard()
    {
        return Auth::guard('usrInventario');
    }
    /**
     * Método para validación de datos de acceso
     * @param  Request $request [Requesto con los credenciales enviados desde formulario]
     * @return String           [String en formato json con la respuesta para cliente]
     */
    public function login(Request $request) {
        $jsonResult = array(
            'success' => true,
            'error' => []
        );
        try {
            $credentials = [
                'usuario' => request('input_usuario'),
                'password' => request('input_contrasenia')
            ];

            if (Auth::guard('usrInventario')->attempt($credentials)) {
                $jsonResult['success'] = true;
            } else {
                $jsonResult['success'] = false;
                $jsonResult['error'] = ['El usuario o contraseña son incorrectos'];
            }
        } catch (Exception $e) {
            Log::error(__CLASS__ . '/' . __FUNCTION__ . ' (Linea: ' . $e->getLine() . '): ' . $e->getMessage());
            $jsonResult['success'] = false;
            $jsonResult['error'] = ['Ocurrió un incidente al procesar su solicitud'];
        }

        return response()->json($jsonResult);
    }
    /**
     * Método para cerrar sesión del usuario
     * @return void [Redirección a la página de login]
     */
    public function logout()
    {
        Auth::guard('usrInventario')->logout();
        return redirect()->route('login');
    }
}
