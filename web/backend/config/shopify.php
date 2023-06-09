<?php

use App\Lib\EnsureBilling;

return [

    /*
    |--------------------------------------------------------------------------
    | Shopify billing
    |--------------------------------------------------------------------------
    |
    | You may want to charge merchants for using your app. Setting required to true will cause the EnsureShopifySession
    | middleware to also ensure that the session is for a merchant that has an active one-time payment or subscription.
    | If no payment is found, it starts off the process and sends the merchant to a confirmation URL so that they can
    | approve the purchase.
    |
    | Learn more about billing in our documentation: https://shopify.dev/docs/apps/billing
    |
    */
    "billing" => [
        "required" => false,

        // Example set of values to create a charge for $5 one time
        "chargeName" => "My Shopify App One-Time Billing",
        "amount" => 5.0,
        "currencyCode" => "USD", // Currently only supports USD
        "interval" => EnsureBilling::INTERVAL_ONE_TIME,
    ],

    'SHOPIFY_ACCESS_TOKEN' => env('SHOPIFY_ACCESS_TOKEN'),
    'SHOPIFY_API_VERSION' => env('SHOPIFY_API_VERSION'),
    'SHOPIFY_API_KEY' => env('SHOPIFY_API_KEY'),
    'SHOPIFY_API_SECRET' => env('SHOPIFY_API_SECRET'),
    'SHOPIFY_API_SCOPES' => implode(',', [
        'read_products',
        'read_product_listings',
        'write_products',
        'read_all_orders',
        'read_orders',
        'write_orders',
        'write_draft_orders',
        'read_customers',
        'write_customers',
    ]),
    'SHOPIFY_APP_HOST' => env('SHOPIFY_APP_HOST'),
    'SHOPIFY_SHOP' => env('SHOPIFY_SHOP'),
    'SHOPIFY_COUNT_LIMIT' => 250,
    'SHOPIFY_SHOP_URL' => sprintf('https://%s', env('SHOPIFY_SHOP')),
];
