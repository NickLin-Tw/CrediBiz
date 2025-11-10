<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Force .env file values to override system environment variables
require __DIR__.'/env_override.php';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // API 未認證時返回 JSON 而非重定向
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->expectsJson()) {
                return null; // 返回 null 讓 Sanctum 處理
            }
            return route('home'); // Web 請求重定向到首頁
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
