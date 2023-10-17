<?php



namespace App\Helper;

use Illuminate\Contracts\Routing\ResponseFactory as RoutingResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;


class ResponseHelper
{

    public static function successResponse($message, $data, $code): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code,
            'status' => true
        ], $code);
    }
    public static function errorResponse($message, $data, $code): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code,
            'status' => false
        ], $code);
    }

}