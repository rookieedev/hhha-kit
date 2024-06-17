<?php 

namespace Rookieedev\HhhaKit\Http\Responses\Macros;

class Critical extends Contracts\ResponseMacro 
{
    /**
     * El alias de la macro de respuesta.
     *
     * @var string
     */
    public string $alias = 'critical';

    /**
     * El código de estado HTTP que se utilizará en la respuesta.
     *
     * @var int
     */
    public int $http_code = 500;

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
    public string $message = 'Errores interno del servidor.';
}
