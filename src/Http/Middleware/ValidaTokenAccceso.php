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
        try{
            $cliente = new \GuzzleHttp\Client();
            if($request->header('Authorization') == null){
                return response()->Forbidden();
            }
            $response = $cliente->request('POST', 'https://api.hhha.cl/auth/check',
                [
                    'verify' => false,
                    'http_errors' => false,
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => $request->header('Authorization')//TOKEN QUE CONOCE EL CLIENTE
                    ]
                ]);

            if ($response->getStatusCode() == 200){
                return $next($request);
            }
            return response()->unauthorized(message:'Usuario no logueado');
        }catch (\Exception $e){
            return response()->critical(message:'No es posible validar el usuario');
        }

    }
}
