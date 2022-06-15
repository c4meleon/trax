<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    protected function response($data, int $statusCode = 200, array $headers = []): JsonResponse
    {
        return response()->json(['data' => $data], $statusCode, $headers);
    }

    protected function responseSuccess(): JsonResponse
    {
        return $this->response(null);
    }

    protected function responseCreated(array $data): JsonResponse
    {
        return $this->response($data, 201);
    }

    protected function responseError(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
           'errors' => [
               'message' => $message,
               'status_code' => $statusCode
           ]
        ], $statusCode);
    }

    // TODO add another few methods like Unautorized, Forbidden etc.
}
