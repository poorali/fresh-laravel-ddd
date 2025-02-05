<?php

use Domain\Monitor\Jobs\LoggerJob;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Infrastructure\Shared\Responses\ApiResponse;
use Infrastructure\Subscription\Middlewares\SubscribedMiddleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withEvents([
        'Domain/User/Listeners',
        'Domain/AI/Listeners',
    ])
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api/v1.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        //We sort auth sanctum middleware to run before tenancy middleware to prevent DB conflict error

        $middleware->priority([
            \Illuminate\Auth\Middleware\Authenticate::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Auth\Middleware\Authorize::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        //Custom message for Policy deny exception
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e) {
            return ApiResponse::send(['permission' => $e->getMessage()], 'error', ['code' => 403]);
        });
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            app('logs')($e);
            return ApiResponse::send(null, 'error', ['code' => 404]);
        });
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e) {
            app('logs')($e);
            return ApiResponse::send(null, 'error', ['code' => 404]);
        });
        $exceptions->render(function (\Illuminate\Database\QueryException $e) {
            app('logs')($e);
            return ApiResponse::send(null, 'error', ['code' => 404]);
        });
        $exceptions->report(function (Throwable $e) {
                LoggerJob::dispatch([
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                ],'error');
        })->stop();
    })->create();
