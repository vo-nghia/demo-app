<?php

namespace App\Services;

use App\Repositories\Shopify\ShopifyProductRepository;

class ProductService
{
    private $shopifyProductRepo;

    public function __construct(ShopifyProductRepository $shopifyProductRepo)
    {
        $this->shopifyProductRepo = $shopifyProductRepo;
    }

    public function getShopifyProducts()
    {
        $products = $this->shopifyProductRepo->getList();

        return $products['products'] ?? [];
    }
}
