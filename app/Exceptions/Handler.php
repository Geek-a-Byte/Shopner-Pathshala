<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/login/admin');
        }
        if ($request->is('writer') || $request->is('writer/*')) {
            return redirect()->guest('/login/writer');
        }
        if ($request->is('teacher') || $request->is('teacher/*')) {
            return redirect()->guest('/login/teacher');
        }
        if ($request->is('guardian') || $request->is('guardian/*')) {
            return redirect()->guest('/login/guardian');
        }
        if ($request->is('doctor') || $request->is('doctor/*')) {
            return redirect()->guest('/login/doctor');
        }
        if ($request->is('nurse') || $request->is('nurse/*')) {
            return redirect()->guest('/login/nurse');
        }
        return redirect()->guest(route('login'));
    }
}
