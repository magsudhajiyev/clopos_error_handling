<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ErrorException;

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

    public function render($request, Exception $exception)
{
    if ($exception instanceof ModelNotFoundException or $exception instanceof NotFoundHttpException)
    {
        if($request->ajax() || $request->wantsJson()) 
        {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }
    }

    // ==> Add this check
    if ($exception instanceof ErrorException) 
    {
        if($request->ajax() || $request->wantsJson()) 
        {
            return response()->json([
                'message' => 'Something went wrong on our side',
            ], 500);
        }
    }

    return parent::render($request, $exception);
}
}
