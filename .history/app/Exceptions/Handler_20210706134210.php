<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psy\Exception\FatalErrorException;

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
        if($exception instanceof FatalErrorException) {
            dd('Here');
            return parent::render($request, $exception);
        }
        if ($exception) {
            // dd($this->getStatusCode());
            return response()->json([
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'http_code' => $exception->getStatusCode()
            ], $exception->getStatusCode());
        }
        return parent::render($request, $exception);
    }
}
