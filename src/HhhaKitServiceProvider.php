<?php

declare(strict_types=1);

namespace Rookieedev\HhhaKit;

use Illuminate\Support\ServiceProvider;

class HhhaKitServiceProvider extends ServiceProvider
{
    protected $response_macros = [

        ///////////////////////////
        ///RESPUESTAS CORRECTAS////
        ///////////////////////////
        \Rookieedev\HhhaKit\Http\Responses\Macros\Created::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\Success::class,

        ///////////////////////////
        ///////ERROR CLIENTE///////
        ///////////////////////////
        \Rookieedev\HhhaKit\Http\Responses\Macros\Errors::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\Unauthorized::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\Forbidden::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\NotFound::class,

        ///////////////////////////
        ///////ERROR SERVER////////
        ///////////////////////////
        //\Rookieedev\HhhaKit\Http\Responses\Macros\Critical::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        foreach($this->response_macros as $response_macro) {
            call_user_func([$response_macro, 'register']);
        }

        app('router')->aliasMiddleware('validaTokenAcceso', \Rookieedev\HhhaKit\Http\Middleware\ValidaTokenAccceso::class);
    }
}