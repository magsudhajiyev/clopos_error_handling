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
        $this->renderable(function (BindingResolutionException $e, $request) {
            // return response()->json([
            //     'message' => $e->getMessage(),
            //     'exception' => get_class($e),
            //     'http_code' => 500
            // ], 500);
        });
    }

    public function render($request, Throwable $exception)
    {
        // dd(get_class($exception));
        if ($exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'http_code' => 500
            ], 500);
        }
        return parent::render($request, $exception);
    }
}
