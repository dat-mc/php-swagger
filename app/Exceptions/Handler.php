<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->is('api/*') && $e) {
            switch (get_class($e)) {
                case \Illuminate\Auth\AuthenticationException::class:
                    return response()->json([
                        'message' => 'Не авторизован'
                    ], Response::HTTP_UNAUTHORIZED);
                case \Illuminate\Auth\Access\AuthorizationException::class:
                    return response()->json([
                        'message' => 'Требуется авторизация'
                    ], Response::HTTP_UNAUTHORIZED);
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    return response()->json([
                        'message' => 'Не найдено'
                    ], Response::HTTP_NOT_FOUND);
                case \Illuminate\Validation\ValidationException::class:
                    return response()->json([
                        'message' => $e->getMessage(),
                        'errors' => collect($e->errors())->flatten()->all()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                default:
                    return response()->json([
                        'message' => $e->getMessage()
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return parent::render($request, $e);
    }
}
