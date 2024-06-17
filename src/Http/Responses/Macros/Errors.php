<?php 

namespace Rookieedev\HhhaKit\Http\Responses\Macros;

/**
 * Class Errors
 *
 * Esta clase define una macro de respuesta para manejar errores en una aplicación Laravel.
 * Extiende de la clase base ResponseMacro para utilizar la funcionalidad de macros personalizadas.
 */
class Errors extends Contracts\ResponseMacro
{
    /**
     * El alias de la macro de respuesta.
     *
     * @var string
     */
    public string $alias = 'errors';

    /**
     * El código de estado HTTP que se utilizará en la respuesta.
     *
     * @var int
     */
    public int $http_code = 422;

    /**
     * Nombre del contenedor
     *
     * @var string
     */
    public string $wrap = 'errors';

    /**
     * El mensaje de la respuesta
     *
     * @var string
     */
    public string $message = 'Errores encontrados en la solicitud.';
}