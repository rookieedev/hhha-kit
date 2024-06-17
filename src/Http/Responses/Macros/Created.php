<?php 

namespace Rookieedev\HhhaKit\Http\Responses\Macros;

class Created extends Contracts\ResponseMacro 
{
    /**
     * El alias de la macro de respuesta.
     *
     * @var string
     */
    public string $alias = 'created';

    /**
     * El código de estado HTTP que se utilizará en la respuesta.
     *
     * @var int
     */
    public int $http_code = 201;

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
    public string $message = 'Registro creado correctamente.';
}
