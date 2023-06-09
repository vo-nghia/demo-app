<?php

namespace App\Services;

use App\Repositories\Shopify\ShopifyOrderRepository;
use App\Repositories\OrderRepository;

class OrderService
{
    private $shopifyOrderRepo;
    private $orderRepo;

    public function __construct(
        ShopifyOrderRepository $shopifyOrderRepo,
        OrderRepository $orderRepo,
    ) {
        $this->shopifyOrderRepo = $shopifyOrderRepo;
        $this->orderRepo = $orderRepo;
    }

    public function syncShopifyOrders()
    {
        return $this->shopifyOrderRepo->sync();
    }
}
