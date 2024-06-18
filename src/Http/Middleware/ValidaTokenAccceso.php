<?php 

declare(strict_types=1);

namespace Rookieedev\HhhaKit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidaTokenAccceso
{
    public function handle(Request $request, Closure $next): Response
    {
        if ( $request->hasHeader('Authorization') ) {

            $response = Http::withHeaders([
                'Accept'        => 'application/json',
                'Authorization' => $request->bearerToken() //TOKEN QUE CONOCE EL CLIENTE
            ])
                ->post('https://api.hhha.cl/auth/check')
                ->withOptions([
                    'verify'      => false,
                    'http_errors' => false,
                ]);

            if ( $response->ok() ) {
                return $next($request);
            }

            return response()->unauthorized(message:'Usuario no logueado');
        }

        return response()->forbidden();
    }
}
