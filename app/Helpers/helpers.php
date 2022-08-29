<?php 

function ObtenerEstadosProducto()
{
    $array = array();
    // dd(Auth::guard('usuarioInterno')->user());
    try {
        $querySangre = DB::select('SHOW COLUMNS FROM producto LIKE "estado"', []);
        if ($querySangre != null) {
            if (count($querySangre) != 0) {
                $array = explode(',', (str_replace(array('enum(', "'", '"', ')'), '', $querySangre[0]->Type)));
            }
        }
    } catch (Exception $e) {
        return $array;
    }
    return $array;
}