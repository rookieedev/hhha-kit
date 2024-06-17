<?php 

namespace Rookieedev\HhhaKit\Http\Contracts;

use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

/**
 * Class MacroAPI
 *
 * Esta clase proporciona diversas utilidades y datos configurables para las macros API.
 */
class MacroAPI 
{   
    /**
     * Obtiene la zona horaria configurada en la aplicación.
     *
     * @return string La zona horaria configurada.
     */
    public final function getTimeZone(): string 
    {
        return Config::get('app.timezone');
    }

    /**
     * Obtiene la configuración regional (locale) actual de la aplicación.
     *
     * @return string La configuración regional actual.
     */
    public final function getLocale(): string
    {
        return Lang::locale();
    }

    /**
     * Obtiene la fecha y hora actual en español.
     *
     * @return string La fecha y hora actual formateada como 'd-m-Y H:i:s'.
     */
    public final function getCurrentDateInSpanish(): string 
    {
        return ( new DateTime('now') )->format('d-m-Y H:i:s');
    }

    /**
     * Obtiene el token API del encabezado de la solicitud.
     *
     * @param Request|null $request La solicitud actual o nula para obtener la solicitud desde el contenedor.
     * @return string El token API del encabezado de la solicitud, o una cadena vacía si no está presente.
     */
    public final function getApiToken(Request $request = null): string
    {
        $request = $request ?? Container::getInstance()->make('request');

        return Str::of($request->header('Authorization'))->after('Bearer')->trim()->value();
    }

   /**
     * Obtiene los datos predeterminados para la macro API.
     *
     * @return array Un arreglo con los datos predeterminados para la macro API.
     */
    public static function getMacro()
    {
        $instance = new self;

        return [
            'time_zone'    => $instance->getTimeZone(),
            'language'     => $instance->getLocale(),
            'date_time'    => $instance->getCurrentDateInSpanish(),
            'client_token' => $instance->getApiToken(),
            'message'      => '',
            'data'         => [],
            'status'       => 200
        ];
    }

}
