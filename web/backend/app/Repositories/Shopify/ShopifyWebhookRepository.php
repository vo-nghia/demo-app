<?php

namespace App\Repositories\Shopify;

use App\Facades\ShopifyClientFacade;

class ShopifyWebhookRepository extends AbstractShopifyRepository
{
    private const RESOURCE_PREFIX = 'webhooks';
    private const RESOURCE_KEY = 'webhook';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($webhookData)
    {
        return ShopifyClientFacade::post(
            sprintf('%s', self::RESOURCE_PREFIX),
            [self::RESOURCE_KEY => $webhookData]
        );
    }
}
