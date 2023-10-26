<?php

namespace App\Exceptions;

use BadMethodCallException;
use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e) {
            if ($e instanceof BadRequestException) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'data' => null,
                    'message' => $e->getMessage()
                ], 400);
            }

            if ($e instanceof NotFoundException) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'data' => null,
                    'message' => $e->getMessage()
                ], 404);
            }

            if ($e instanceof NotFoundHttpException) {
                // Menampilkan halaman 404

                return response()->view('errors.404', ['message' => $e->getMessage()], 404);
            }
            if ($e instanceof WebException) {
                // mengirim error sesuai message web exceptions
                DB::rollBack();
                return back()->withErrors($e->getMessage());
            }

            if ($e instanceof BadMethodCallException) {
                return response()->view('errors.500', ["message" => $e->getMessage()], 500);
            }
            // dd($e);
            if ($e instanceof ForbiddenException) {
                return response()->json([
                    'status' => false,
                    'code' => 403,
                    'data' => null,
                    'message' => $e->getMessage()
                ], 403);
            }
            if ($e instanceof UnauthorizedException) {
                return response()->json([
                    'status' => false,
                    'code' => 401,
                    'data' => null,
                    'message' => $e->getMessage()
                ], 401);
            }

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return back()->withErrors($e->validator)->withInput();
            }
            DB::rollBack();
            return response()->json([
                'status' => false,
                'code' => 500,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        },);
    }
}
