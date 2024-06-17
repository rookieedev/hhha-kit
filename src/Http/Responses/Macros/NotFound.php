<?php 

namespace Rookieedev\HhhaKit\Http\Responses\Macros;

class NotFound extends Contracts\ResponseMacro
{
    public string $alias   = 'notFound';

    public int $http_code  = 404;

    public string $message = 'No encontrado';
}