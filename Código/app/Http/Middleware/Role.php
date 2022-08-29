<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //https://laracasts.com/discuss/channels/laravel/middleware-parameters-comma-separated-52
        $roles = Arr::except(func_get_args(), [0, 1]);
        // dd($roles);
        if (Auth::guard('usrInventario')->guest()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error'   => ['401 - No tiene permiso para acceder a este recurso'] //Recurso para datatable
                ]); 
            } else {
                return response()->view('public.error-pages.error-page', ['codigoError' => 401]);
            }
        } else {
            // dd('entra');
            $role_name = null;
            // dd(Auth::guard('usrInventario')->user()->idRol);
            if (Auth::guard('usrInventario')->user()->idPerfil) {
                $role_name = Auth::guard('usrInventario')->user()->idPerfil;
            }

            if (!in_array((string)$role_name, $roles, true)) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'error'  => ['401 - No tiene permiso para acceder a este recurso',
                    ]]); 
                } else {
                    return response()->view('public.error-pages.error-page', ['codigoError' => 401]);
                }
            }
        }

        return $next($request);
    }
}
