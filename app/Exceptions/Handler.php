<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

        $this->renderable(function (Throwable $exception) {
            if($exception instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response()->json(['message' => 'Route not found'], 404);
            }
    
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }
    
            if ($exception instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
    
            if ($exception instanceof ValidationException) {
                return response()->json(['message' => 'Validation failed', 'errors' => $exception->errors()], 422);
            }
    
            if ($exception instanceof AuthorizationException) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
    
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['message' => 'Method not allowed'], 405);
            }
    
            if ($exception instanceof BadRequestHttpException) {
                return response()->json(['message' => 'Bad request'], 400);
            }
    
            if ($exception instanceof TooManyRequestsHttpException) {
                return response()->json(['message' => 'Too many requests'], 429);
            }

            if ($exception instanceof \Illuminate\Database\QueryException) {
                //comment this line for sql debug
                //return response()->json(['message' => 'Unprocessable Entity'], 422);
            }

            if ($exception instanceof \TypeError) {
                //comment this line for sql debug
                //return response()->json(['message' => 'Internal server error'], 500);
            }

            if($exception instanceof \ErrorException) {
                //comment this line for debug
                //return response()->json(['message' => 'Internal server error'], 500);
            }
            
        });
    
    }
}
