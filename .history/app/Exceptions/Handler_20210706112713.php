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

    public function render($request, Throwable $exception)
    {
        if ($exception) {
            if ($exception instanceof \GuzzleHttp\Exception\ServerException) {
                return redirect('/');
            }
            // dd($exception);
            return response()->json([
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'http_code' => $exception->getstatusCode()
            ], $exception->getstatusCode());
        }
        return parent::render($request, $exception);
    }
}
