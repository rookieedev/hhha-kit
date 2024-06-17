<?php

namespace Rookieedev\HhhaKit\Http\Responses\Macros;

class Unauthorized extends Contracts\ResponseMacro
{
    /**
     * El alias de la macro de respuesta.
     *
     * @var string
     */
    public string $alias = 'unauthorized';

    /**
     * El código de estado HTTP que se utilizará en la respuesta.
     *
     * @var int
     */
    public int $http_code = 401;

    /**
     * Nombre del contenedor
     *
     * @var string
     */
    public string $wrap = 'error';

    /**
     * El mensaje de la respuesta
     *
     * @var string
     */
    public string $message = 'Usuario no autorizado.';
}