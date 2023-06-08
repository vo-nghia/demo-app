<?php

namespace App\Services;

use App\Repositories\Shopify\ShopifyProductRepository;
use App\Repositories\ProductRepository;

class ProductService
{
    private $shopifyProductRepo;
    private $productRepo;

    public function __construct(
        ShopifyProductRepository $shopifyProductRepo,
        ProductRepository $productRepo,
    ) {
        $this->shopifyProductRepo = $shopifyProductRepo;
        $this->productRepo = $productRepo;
    }

    public function syncShopifyProducts()
    {
        $shopifyResponse = $this->shopifyProductRepo->sync();

        foreach ($shopifyResponse['products'] as $product) {
            $this->storeNewProduct($product);
        }
    }

    public function getList()
    {
        $products = $this->productRepo->getList();

        return $products->toArray() ?? [];
    }
    
    public function getShopifyProductsCount()
    {
        $productsCount = $this->productRepo->count();
        
        return $productsCount ?? 0;
    }

    public function create($productData)
    {
        $newProduct = $this->shopifyProductRepo->create($productData);
        return $this->storeNewProduct($newProduct['product']);
    }

    public function get($productData)
    {
       return $this->productRepo->find($productData);
    }

    private function storeNewProduct($newProductData)
    {
        return $this->productRepo->saveToDB($newProductData);
    }

    public function deleteShopifyProducts($productId)
    {
        $product = $this->productRepo->find($productId);
        if (!$product) {
            return;
        }
        // delete product in shopify store
        $this->shopifyProductRepo->delete($product['store_product_id']);
        return $this->productRepo->delete($productId);
    }
}
