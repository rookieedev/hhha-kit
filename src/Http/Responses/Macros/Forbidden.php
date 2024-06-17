<?php

namespace Rookieedev\HhhaKit\Http\Responses\Macros;

class Forbidden
{
    /**
     * El alias de la macro de respuesta.
     *
     * @var string
     */
    public string $alias = 'forbidden';

    /**
     * El código de estado HTTP que se utilizará en la respuesta.
     *
     * @var int
     */
    public int $http_code = 403;

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
    public string $message = 'Sin token de acceso.';
}