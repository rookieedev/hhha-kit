<?php

declare(strict_types=1);

namespace Rookieedev\HhhaKit;

use Illuminate\Support\ServiceProvider;

class HhhaKitServiceProvider extends ServiceProvider
{
    protected $response_macros = [
        \Rookieedev\HhhaKit\Http\Responses\Macros\Errors::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\NotFound::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\Critical::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\Created::class,
        \Rookieedev\HhhaKit\Http\Responses\Macros\Success::class,
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