<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception) {
    //         dd($exception->getMessage());
    //         if ($exception instanceof \ErrorException) {
    //             // (For 5xx codes)
    //             dd('Here');
    //             return redirect()->route('home');
    //         }
    //         // dd($exception);
    //         // switch($exception->getStatusCode())
    //         return response()->json([
    //             'message' => $exception->getMessage(),
    //             'exception' => get_class($exception),
    //             'http_code' => $exception->getstatusCode()
    //         ], $exception->getstatusCode());
    //     }
    //     return parent::render($request, $exception);
    // }

    public function render($request, Exception $e)
{

    // 404 page when a model is not found
    if ($e instanceof ModelNotFoundException) {
        return response()->view('errors.404', [], 404);
    }

    // custom error message
    if ($e instanceof \ErrorException) {
        return response()->view('errors.500', [], 500);
    } else {
        return parent::render($request, $e);
    }

    return parent::render($request, $e);
}
}
