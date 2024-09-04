<?php

use App\Http\Middleware\RolUsuario;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //! Sirve para registrar middleware personalizados en la aplicación
        //! $middleware->register('rol', RolUsuario::class);
        //!tambien sirve para darle un alias a un middleware
        //! $middleware->alias('rol', RolUsuario::class);
        //! colocamos un alias para el middleware RolUsuario
        $middleware->alias(['rol.reclutador' => RolUsuario::class,]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //! Sirve para registrar excepciones personalizadas en la aplicación 
        //! por ejemplo si queremos que cuando se lance una excepcion de tipo NotFoundHttpException se ejecute un metodo en un controlador
        //! $exceptions->register(NotFoundHttpException::class, [HomeController::class, 'notFound']);
    })->create();
