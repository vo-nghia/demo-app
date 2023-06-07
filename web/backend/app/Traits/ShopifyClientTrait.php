<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Enums\ShopifyHttpResponseErrorCode;
use App\Enums\ShopifyResponseDataType;
use App\Enums\ShopifyEnvironment;
use Shopify\Clients\Rest;

class ShopifyClientTrait
{
    private static $LOG_PREFIX = 'Shopify Api Response: ';

    private static $env;

    public static function get(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        try {
            $response = self::getRaw($path, $headers, $query, $tries);

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                self::logError(
                    $response->getReasonPhrase(),
                    $path,
                    $headers,
                    $query,
                    null,
                    $response->getDecodedBody()
                );

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            self::logError($e, $path, $headers, $query);

            return null;
        }
    }

    public static function post(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        try {
            $response = self::postRaw($path, $body, $headers, $query, $tries, $dataType);

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                self::logError(
                    $response->getReasonPhrase(),
                    $path,
                    $headers,
                    $query,
                    $body,
                    $response->getDecodedBody()
                );

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            self::logError($e, $path, $headers, $query, $body);

            return null;
        }
    }

    public static function put(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        try {
            $response = self::putRaw($path, $body, $headers, $query, $tries, $dataType);

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                self::logError(
                    $response->getReasonPhrase(),
                    $path,
                    $headers,
                    $query,
                    $body,
                    $response->getDecodedBody()
                );

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            self::logError($e, $path, $headers, $query, $body);

            return null;
        }
    }

    public static function delete(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        try {
            $response = self::deleteRaw($path, $headers, $query, $tries);

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                self::logError(
                    $response->getReasonPhrase(),
                    $path,
                    $headers,
                    $query,
                    null,
                    $response->getDecodedBody()
                );

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            self::logError($e, $path, $headers, $query);

            return null;
        }
    }

    public static function getRaw(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        $client = self::getClient();

        return $client->get($path, $headers, $query, $tries);
    }

    public static function postRaw(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        $client = self::getClient();

        return $client->post($path, $body, $headers, $query, $tries, $dataType);
    }

    public static function putRaw(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        $client = self::getClient();

        return $client->put($path, $body, $headers, $query, $tries, $dataType);
    }

    public static function deleteRaw(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        $client = self::getClient();

        return $client->delete($path, $headers, $query, $tries);
    }

    private static function getClient()
    {
        return match (self::$env) {
            ShopifyEnvironment::LOCAL => new Rest(config('shopify.SHOPIFY_SHOP'), config('shopify.SHOPIFY_ACCESS_TOKEN')),
            default => new Rest(config('shopify.SHOPIFY_SHOP'), config('shopify.SHOPIFY_ACCESS_TOKEN'))
        };
    }

    private static function logError(
        \Throwable|string $exception,
        string $path,
        array $headers,
        array $query,
        mixed $body = null,
        ?array $response = null
    ): void {
        try {
            $msg = is_string($exception)
                ? sprintf('%s%s', self::$LOG_PREFIX, $exception)
                : sprintf('%s Exception: %s', class_basename(self::class), $exception->getMessage());
            $logData = [
                'endpoint' => sprintf('%s.json', $path),
                'headers' => $headers,
                'query' => $query,
                'body' => $body ?: [],
                'response' => $response
            ];
            if (request()->route()) {
                $logData['request url'] = request()->fullUrl();
                $logData['request'] = request()->all();
                $logData['request_headers'] = request()->header();
            }
            $debugBackTrace = collect(debug_backtrace());
            $useStageIdx = $debugBackTrace
                ->where('class', self::class)
                ->keys()
                ->last();
            $logData['tracking'] = $debugBackTrace->get($useStageIdx + 1);

            \Log::error(
                $msg,
                $logData
            );
        } catch (\Exception $e) {
            log_debug_exception_not_http_request($e, 'ShopifyClientTrait logError');
        }
    }
}
