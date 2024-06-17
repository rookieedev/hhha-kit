<?php

declare(strict_types=1);

namespace Rookieedev\HhhaKit\Util;

use DateTime;

class Tiempo 
{
    /**
     * Retorna el tiempo transcurrido para ser mostrado como edad
     *
     * @param  string        $inicio
     * @param  string        $formato
     * @param  DateTime|null $final
     *
     * @return string
     */
    public static function calcularEdad(string $inicio, string $formato = 'Y-m-d H:i:s', DateTime $final = null): string
    {
        $inicio       = DateTime::createFromFormat($formato, $inicio);
        $final        = $final ?? new DateTime('now');
        $edad         = null;
        $transcurrido = self::transcurrido($inicio, $final);
        
        if ($transcurrido->y > 0) {
            $edad = $transcurrido->y . ($transcurrido->y > 1 ? ' años' : 'año');
        } elseif ($transcurrido->m > 0) {
            $edad = $transcurrido->m . ($transcurrido->m > 1 ? ' meses' : 'mes');
        } else {
            $edad = $transcurrido->d . ($transcurrido->d > 1 ? ' días' : ' día');
        }

        return $edad;
    }

    /**
     * Calcula tiempo transcurrido
     *
     * @param  DateTime $inicio
     * @param  DateTime $final
     *
     * @return object
     */
    public static function transcurrido(DateTime $inicio, DateTime $final)
    {
        return $inicio->diff($final);
    }
}