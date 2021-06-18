<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return $this->handleException($request, $exception);
    }

    /**
     * Handle a Exception and return the correct response
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    protected function handleException($request, Throwable $exception)
    {
        if($exception instanceof HttpException) {
            $code = $exception->getStatusCode();

            return $this->response(
                [],
                Response::$statusTexts[$code],
                $code
            );
        }

        if($exception instanceof ModelNotFoundException) {
            $model_name = strtolower(class_basename($exception->getModel()));

            return $this->response(
                [],
                "Does not exist any instance of {$model_name} with given id",
                Response::HTTP_NOT_FOUND
            );
        }

        if($exception instanceof AuthorizationException) {
            return $this->response(
                [],
                $exception->getMessage(),
                Response::HTTP_FORBIDDEN
            );
        }

        if($exception instanceof AuthenticationException) {
            return $this->response(
                [],
                $exception->getMessage(),
                Response::HTTP_UNAUTHORIZED
            );
        }

        if($exception instanceof ValidationException) {
            return $this->response(
                $exception->validator->errors()->getMessages(),
                "Your request has invalid fields",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $this->response(
            [],
            config('app.debug') ? $exception->getMessage() : "Sorry, an unexpected error occurred. Please, try later",
            Response::HTTP_INTERNAL_SERVER_ERROR
        );

    }
}
