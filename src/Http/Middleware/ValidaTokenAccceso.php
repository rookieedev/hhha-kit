<?php 

declare(strict_types=1);

namespace Rookieedev\HhhaKit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidaTokenAccceso
{
    public function handle(Request $request, Closure $next)
    {
        $usuario = (object) [
            'id' => '10'
        ];

        $request->setUserResolver( fn() => $usuario);

        return $next($request);
    }
}
