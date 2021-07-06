<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    /**
     *
     * Success Response
     *
     * @param array $data
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     *
     *
     */
    public function successResponse(array $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($data, $code, [
            'Content-Type',
            'application/json'
        ]);
    }

    /**
     *
     * Error Response
     *
     * @param string $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function errorResponse(string $message, int $code): JsonResponse
    {
        $error = [
            'error' => $message,
            'code' => $code
        ];

        return new JsonResponse($error, $code, [
            'Content-Type',
            'application/json'
        ]);
    }

    /**
     *
     * Errors Response
     *
     * @param string $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function errorsResponse(array $error, int $code): JsonResponse
    {
        return new JsonResponse($error, $code, [
            'Content-Type',
            'application/json'
        ]);
    }
}