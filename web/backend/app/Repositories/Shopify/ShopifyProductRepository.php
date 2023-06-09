<?php

namespace App\Repositories\Shopify;

use App\Facades\ShopifyClientFacade;

class ShopifyProductRepository extends AbstractShopifyRepository
{
    private const RESOURCE_PREFIX = 'products';
    private const RESOURCE_KEY = 'product';

    public function __construct()
    {
        parent::__construct();
    }

    public function sync()
    {
        return ShopifyClientFacade::get(sprintf('%s', self::RESOURCE_PREFIX), []);
    }

    public function create($productData)
    {
        return ShopifyClientFacade::post(
            sprintf('%s', self::RESOURCE_PREFIX),
            [self::RESOURCE_KEY => $productData]
        );
    }

    public function update($productId, $productData)
    {
        return ShopifyClientFacade::put(
            sprintf('%s/%s', self::RESOURCE_PREFIX, $productId),
            [self::RESOURCE_KEY => $productData]
        );
    }

    public function getShopifyProductsCount()
    {
        return ShopifyClientFacade::get(sprintf('%s/count', self::RESOURCE_PREFIX), []);
    }

    public function delete($productId)
    {
        return ShopifyClientFacade::delete(
            sprintf('%s/%s', self::RESOURCE_PREFIX, $productId)
        );
    }
}
