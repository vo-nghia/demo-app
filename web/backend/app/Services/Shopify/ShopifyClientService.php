<?php

namespace App\Services\Shopify;

use Shopify\Clients\Rest;
use App\Enums\ShopifyResponseDataType;
use App\Enums\ShopifyHttpResponseErrorCode;
use Shopify\Clients\Graphql;

class ShopifyClientService
{
    private const LOG_PREFIX = 'Shopify Api Response: ';

    public function get(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        try {
            $response = $this->getRaw($path, $headers, $query, $tries);
            // Log::info($response->getDecodedBody());

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                $this->logError("GET: {$path}, " . $response->getReasonPhrase());

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            $this->logError("GET: {$path}, " . $e->getMessage() . $path);

            return null;
        }
    }

    public function post(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        try {
            $response = $this->postRaw($path, $body, $headers, $query, $tries, $dataType);
            // Log::info($response->getDecodedBody());

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                $this->logError("POST: {$path}, " . $response->getReasonPhrase());

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            $this->logError("POST: {$path}, " . $e->getMessage());

            return null;
        }
    }

    public function put(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        try {
            $response = $this->putRaw($path, $body, $headers, $query, $tries, $dataType);
            // Log::info($response->getDecodedBody());

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                $this->logError("PUT: {$path}, " . $response->getReasonPhrase());

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            $this->logError("PUT: {$path}, " . $e->getMessage());

            return null;
        }
    }

    public function delete(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        try {
            $response = $this->deleteRaw($path, $headers, $query, $tries);

            if (in_array($response->getStatusCode(), ShopifyHttpResponseErrorCode::getValues(), true)) {
                $this->logError($response->getReasonPhrase());

                return null;
            }

            return $response->getDecodedBody();
        } catch (\Exception $e) {
            $this->logError($e->getMessage());

            return null;
        }
    }

    public function getRaw(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        $client = $this->getClient();

        return $client->get($path, $headers, $query, $tries);
    }

    public function postRaw(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        $client = $this->getClient();

        return $client->post($path, $body, $headers, $query, $tries, $dataType);
    }

    public function putRaw(
        string $path,
        string|array $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = ShopifyResponseDataType::DATA_TYPE_JSON
    ) {
        $client = $this->getClient();

        return $client->put($path, $body, $headers, $query, $tries, $dataType);
    }

    public function deleteRaw(
        string $path,
        array $headers = [],
        array $query = [],
        ?int $tries = null
    ) {
        $client = $this->getClient();

        return $client->delete($path, $headers, $query, $tries);
    }

    public static function query($data, array $query = [], array $extraHeaders = [], ?int $tries = null)
    {
        $client = self::getClientGraphql();

        return $client->query($data, $query, $extraHeaders, $tries);
    }

    private static function getClientGraphql()
    {
        return new Graphql(
            config('shopify.SHOPIFY_SHOP'),
            config('shopify.SHOPIFY_ACCESS_TOKEN')
        );
    }

    private function getClient()
    {
        return new Rest(
            config('shopify.SHOPIFY_SHOP'),
            config('shopify.SHOPIFY_ACCESS_TOKEN')
        );
    }

    private function logError(string $msg)
    {
        \Log::error(sprintf(
            '%s%s',
            self::LOG_PREFIX,
            $msg
        ));
    }
}
