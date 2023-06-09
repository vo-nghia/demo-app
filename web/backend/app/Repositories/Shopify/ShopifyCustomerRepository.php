<?php

namespace App\Repositories\Shopify;

use App\Facades\ShopifyClientFacade;

class ShopifyCustomerRepository extends AbstractShopifyRepository
{
    private const RESOURCE_PREFIX = 'customers';
    private const RESOURCE_KEY = 'customer';

    public function __construct()
    {
        parent::__construct();
    }

    public function sync()
    {
        return ShopifyClientFacade::get(sprintf('%s', self::RESOURCE_PREFIX), []);
    }
}
