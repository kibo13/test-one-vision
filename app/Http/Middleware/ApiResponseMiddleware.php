<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $formattedResponse = $this->formatResponse($response);
            return response()->json($formattedResponse, $response->getStatusCode());
        }

        return $response;
    }

    /**
     * Format the response based on success or failure.
     *
     * @param JsonResponse $response
     * @return array
     */
    private function formatResponse(JsonResponse $response): array
    {
        $responseData = $response->getData();

        return $response->isSuccessful()
            ? $this->formatSuccessResponse($responseData)
            : $this->formatFailureResponse($responseData);
    }

    /**
     * Format the response for a successful request.
     *
     * @param  mixed  $data
     * @return array
     */
    private function formatSuccessResponse(mixed $data): array
    {
        $formattedResponse = [
            'status' => 'success',
            'message' => $data->message ?? 'Success',
        ];

        foreach ($data as $key => $value) {
            if ($key !== 'message') {
                $formattedResponse[$key] = $value;
            }
        }

        return $formattedResponse;
    }

    /**
     * Format the response for a failure.
     *
     * @param  mixed  $data
     * @return array
     */
    private function formatFailureResponse(mixed $data): array
    {
        $formattedResponse = [
            'status' => 'failure',
            'message' => $data->message ?? 'Failure',
        ];

        if (! empty($data->errors)) {
            $errorMessages = [];

            foreach ($data->errors as $fieldErrors) {
                $errorMessages[] = is_array($fieldErrors) ? reset($fieldErrors) : $fieldErrors;
            }

            $formattedResponse['message'] = count($errorMessages) > 0 ? $errorMessages[0] : 'Validation failed';
        }

        foreach ($data as $key => $value) {
            if ($key !== 'message') {
                $formattedResponse[$key] = $value;
            }
        }

        return $formattedResponse;
    }
}
