<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Enums\HttpResponseCode;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    /**
     * @var string
     */
    private static $failedStatus = 'Failed';

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function success(array $data = []): JsonResponse
    {
        return response()->json(['message' => HttpResponseCode::getDescription(HttpResponseCode::HTTP_OK)] + $data);
    }

    /**
     * @param int $httpCode
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function error(int $httpCode, string $message = ''): JsonResponse
    {
        if (empty($message)) {
            $message = $this->getMessage($httpCode);
        }

        return response()->json(
            [
                'message' => $message,
            ],
            $httpCode
        );
    }

    /**
     * @return JsonResponse
     */
    protected function notFound(): JsonResponse
    {
        return $this->error(Response::HTTP_NOT_FOUND);
    }

    /**
     * @return JsonResponse
     */
    protected function unAuthorize(): JsonResponse
    {
        return $this->error(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param mixed $httpCode
     *
     * @return string
     */
    protected function getMessage($httpCode): string
    {
        if (empty($message)) {
            $message = match ($httpCode) {
                HttpResponseCode::HTTP_BAD_REQUEST,
                HttpResponseCode::HTTP_UNAUTHORIZED,
                HttpResponseCode::HTTP_FORBIDDEN,
                HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY,
                HttpResponseCode::HTTP_TOO_MANY_REQUESTS,
                HttpResponseCode::HTTP_NOT_ACCEPTABLE,
                HttpResponseCode::HTTP_METHOD_NOT_ALLOWED,
                HttpResponseCode::HTTP_SERVER_ERROR,
                HttpResponseCode::HTTP_NOT_FOUND => HttpResponseCode::getDescription($httpCode),
                default => HttpResponseCode::getDescription(HttpResponseCode::HTTP_ERROR),
            };
        }

        return $message;
    }

    /**
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function responseFailed(string $message = ''): JsonResponse
    {
        return response()->json(
            [
                'status' => self::$failedStatus,
                'message' => $message ?: HttpResponseCode::getDescription(HttpResponseCode::HTTP_BAD_REQUEST)
            ],
            HttpResponseCode::HTTP_OK
        );
    }
}
