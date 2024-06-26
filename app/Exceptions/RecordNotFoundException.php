<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RecordNotFoundException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Запись не найдена'
        ], Response::HTTP_NOT_FOUND);
    }
}
