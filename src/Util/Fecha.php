<?php 

namespace Rookieedev\HhhaKit\Util;

class Fecha
{
    public static function cambiarFormato( string $fecha = null, string $formato_salida = 'd-m-Y' ): string
    {
        if ( blank($fecha) ) {
            return '';
        }

        return date_format( date_create($fecha) , $formato_salida );
    }
}