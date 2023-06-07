<?php

namespace App\Repositories\Shopify;

use App\Services\SessionService;
use Shopify\Context;

abstract class AbstractShopifyRepository
{
    public function __construct()
    {
        $shopifyApiKey = config('shopify.SHOPIFY_API_KEY') ?: env('SHOPIFY_API_KEY');
        $shopifyApiSecret = config('shopify.SHOPIFY_API_SECRET') ?: env('SHOPIFY_API_SECRET');
        $shopifyApiScopes = config('shopify.SHOPIFY_API_SCOPES') ?: env('SHOPIFY_API_SCOPES');
        $shopifyAppHost = config('shopify.SHOPIFY_APP_HOST') ?: env('SHOPIFY_APP_HOST');
        $shopifyApiVersion = config('shopify.SHOPIFY_API_VERSION') ?: env('SHOPIFY_API_VERSION');

        Context::initialize(
            $shopifyApiKey,
            $shopifyApiSecret,
            $shopifyApiScopes,
            preg_replace('/(http|https):\/\//i', '', $shopifyAppHost),
            new SessionService(),
            $shopifyApiVersion
        );
    }
}
