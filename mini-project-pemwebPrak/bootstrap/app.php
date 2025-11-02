<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ✅ Tambahkan middleware SessionTimeout ke grup "web"
        $middleware->web(append: [
            \App\Http\Middleware\SessionTimeout::class,
        ]);

        // ✅ (Opsional) Daftarkan alias juga biar bisa dipanggil manual di route
        $middleware->alias([
            'session.timeout' => \App\Http\Middleware\SessionTimeout::class,
        ]);
    }) // ← ini penting, tutup blok middleware dulu, baru lanjut ke exceptions
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();