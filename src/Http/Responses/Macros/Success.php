<?php 

namespace Rookieedev\HhhaKit\Http\Responses\Macros;

class Success extends Contracts\ResponseMacro
{
    /**
     * El alias de la macro de respuesta.
     *
     * @var string
     */
    public string $alias = 'success';

    /**
     * El código de estado HTTP que se utilizará en la respuesta.
     *
     * @var int
     */
    public int $http_code = 200;

    /**
     * Nombre del contenedor
     *
     * @var string
     */
    public string $wrap = 'data';

    /**
     * El mensaje de la respuesta
     *
     * @var string
     */
    public string $message = 'Aceptado.';
}
