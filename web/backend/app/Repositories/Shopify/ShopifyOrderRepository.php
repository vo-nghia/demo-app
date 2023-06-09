<?php

namespace App\Repositories\Shopify;

use App\Facades\ShopifyClientFacade;
use App\Traits\ShopifyClientTrait;
use App\Dtos\Shopify\OrderDto;

class ShopifyOrderRepository extends AbstractShopifyRepository
{
    private const RESOURCE_PREFIX = 'orders';
    private const RESOURCE_KEY = 'order';
    private const CANCEL_KEY = 'cancel';
    private const CLOSE_KEY = 'close';

    public function __construct()
    {
        parent::__construct();
    }

    public function sync()
    {
        return ShopifyClientTrait::get(sprintf('%s', self::RESOURCE_PREFIX));  
    }
}
