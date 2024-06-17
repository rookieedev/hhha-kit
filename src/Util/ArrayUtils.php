<?php 

namespace Rookieedev\HhhaKit\Util;

class ArrayUtils 
{
    public static function mapRecursive(array $arreglo, callable $closure)
    {
        foreach ($arreglo as $clave => $valor) {
            $arreglo[$clave] = is_array($valor) ? self::mapRecursive($valor, $closure) : $closure($valor);
        }
        
        return $arreglo;
    }
}