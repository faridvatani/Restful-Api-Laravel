<?php

namespace App\Exceptions;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return bool|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            return $this->NotFoundExceptionMessage($request, $exception);
        }
        return parent::render($request, $exception);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function NotFoundExceptionMessage(\Illuminate\Http\Request $request, $exception)
    {
        return $request->expectsJson()
            ? new JsonResponse([
                'data' => 'Not Found',
                'status' => '404'
            ], Response::HTTP_NOT_FOUND)
            : parent::render($request, $exception);
    }
}
