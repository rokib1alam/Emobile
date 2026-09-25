<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            // Your custom middleware
            'role.custom' => \App\Http\Middleware\RoleMiddleware::class,  // <-- Add your custom middleware here
        ]);
            $middleware->statefulApi();
            $middleware->validateCsrfTokens(except: [
                'sslcommerz/*',
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            // যদি Ajax বা JSON প্রত্যাশা করে, তাহলে JSON রেসপন্স
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'যে রিসোর্স আপনি খুঁজছেন তা পাওয়া যায়নি।'
                ], 404);
            }

            // অন্যথায় আপনার কাস্টম ভিউ-তে ডাটা পাঠিয়ে রেন্ডার
            // $contact   = Setting::find(1);
            // $team1     = Team::find(1);
            // $team2     = Team::find(2);
            // $products  = Product::with('category')->get();

            return response()
                ->view('frontend.errors.404');
        });
        //
    })->create();
