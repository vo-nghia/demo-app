<?php

namespace App\Repositories\Shopify;

use App\Facades\ShopifyClientFacade;

class ShopifyProductRepository extends AbstractShopifyRepository
{
    private const RESOURCE_PREFIX = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
        return ShopifyClientFacade::get(sprintf('%s', self::RESOURCE_PREFIX), []);
    }
}
