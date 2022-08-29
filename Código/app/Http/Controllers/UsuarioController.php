<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UsuarioController extends Controller
{
    /**
     * Método para registro de usuarios a sistema
     * @param  UsuarioRequest $request [Información a registrar del usuario]
     * @return String                  [JSON con el estado de registro del usuario]
     */
    public function registerUser(UsuarioRequest $request) {
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
                    Usuario::create([
                        'nombre' => $request['nombre'],
                        'apPaterno' => $request['apPaterno'],
                        'apMaterno' => $request['apMaterno'],
                        'usuario' => $request['nomUsuario'],
                        'contrasenia' => Hash::make($request['contrasenia']),
                        'acceso' => 1,
                        'idPerfil' => $request['permiso'],
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
}
