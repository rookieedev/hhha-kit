<?php 

namespace Rookieedev\HhhaKit\Http\Responses\Macros\Contracts;

use Illuminate\Support\Facades\Response;
use Rookieedev\HhhaKit\Http\Contracts\MacroAPI;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ResponseMacro
 *
 * Esta clase se utiliza para registrar macros de respuesta personalizada en una aplicación Laravel.
 */
class ResponseMacro
{
    /**
     * El alias de la macro de respuesta.
     *
     * @var string
     */   
    public string $alias = '';

    /**
     * El código de estado HTTP que se utilizará en la respuesta.
     *
     * @var int
     */
    public int $http_code = 200;

    /**
     * El mensaje de la respuesta
     *
     * @var string
     */
    public string $message = '';

    /**
     * Nombre del contenedor
     *
     * @var string
     */
    public string $wrap = 'data';


    /**
     * Registra la macro de respuesta.
     *
     * Este método registra una macro de respuesta JSON personalizada si el alias no está vacío.
     * La macro se define como una función anónima que fusiona los datos de la respuesta y 
     * establece el mensaje y las opciones de respuesta.
     *
     * @return void
     */
    public static function register()
    {
        $instance = new static;

        if ( ! empty( $instance->getAlias() ) ) {

            $json = function (array|MessageBag|Collection $data = [], string $message = '') use ($instance) {
                $macro = MacroAPI::getMacro();

                if ( $instance->getWrap() != 'data' ) {
                    $macro[$instance->getWrap()] = $macro['data'];
                    unset($macro['data']);
                }

                if ( is_a($data, MessageBag::class) || is_a($data, Collection::class ) ) {
                    $data = $data->toArray();
                }

                $macro[$instance->getWrap()] = array_merge($macro[$instance->getWrap()], $data);

                $macro['status']             = $instance->getHttpCode();

                $macro['message']            = empty($message) ?  $instance->getMessage() : $message;

                ksort($macro);

                return Response::json(
                    data    : $macro,
                    status  : $instance->getHttpCode(),
                    options : $instance->getOptions(),
                    headers : $instance->getHeaders()
                );
            };

            Response::macro($instance->getAlias(), $json);        
        }
    }

    /**
     * Obtiene el alias de la macro de respuesta.
     *
     * @return string El alias de la macro.
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Obtiene el código de estado HTTP de la respuesta.
     *
     * @return int El código de estado HTTP.
     */
    public function getHttpCode(): int 
    {
        return $this->http_code;
    }

    /**
     * Obtiene los encabezados de la respuesta.
     *
     * @return array Los encabezados de la respuesta.
     */
    public function getHeaders(): array  
    {
        return ['Content-Type' => 'application/json'];
    }

    /**
     * Obtiene las opciones de codificación JSON para la respuesta.
     *
     * @return int Las opciones de codificación JSON.
     */
    public function getOptions() 
    {
        return JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;
    }

    /**
     * Obtiene el mensaje de la respuesta
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Obtiene el nombre del contenedor
     *
     * @return string
     */
    public function getWrap(): string 
    {
        return $this->wrap;
    }
}