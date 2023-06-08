<?php

namespace App\Repositories;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductRepository extends AbstractRepository
{
    public function modelClass(): string
    {
        return Product::class;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function count()
    {
        return Product::count();
    }

    public function getList()
    {
        return Product::with('variants')->get();
    }

    public function saveToDB($product)
    {
        DB::transaction(function () use ($product) {
                $productId = $this->saveProductTable($product);
                foreach ($product['variants'] as $variant) {
                    $this->saveVariantTable($variant, $productId, $product['id']);
                }
        });
    }

    private function saveProductTable($product)
    {
        return DB::table('products')->insertGetId([
            'store_product_id' => $product['id'],
            'title' => $product['title'],
            'body_html' => $product['body_html'],
            'vendor' => $product['vendor'],
            'product_type' => $product['product_type'],
            'store_created_at' => $product['created_at'],
            'handle' => $product['handle'],
            'store_updated_at' => $product['updated_at'],
            'published_at' => $product['published_at'],
            'template_suffix' => $product['template_suffix'],
            'published_scope' => $product['published_scope'],
            'tags' => $product['tags'],
            'admin_graphql_api_id' => $product['admin_graphql_api_id'],
            'synced_at' => Carbon::now()
        ]);
    }

    private function saveVariantTable($variant, $productId, $storeProductId)
    {
        return DB::table('variants')->insert([
            'product_id' => $productId,
            'store_variant_id' => $variant['id'],
            'store_product_id' => $storeProductId,
            'title' => $variant['title'],
            'price' => $variant['price'],
            'sku' => $variant['sku'],
            'position' => $variant['position'],
            'inventory_policy' => $variant['inventory_policy'],
            'compare_at_price' => $variant['compare_at_price'],
            'fulfillment_service' => $variant['fulfillment_service'],
            'inventory_management' => $variant['inventory_management'],
            'option1' => $variant['option1'],
            'option2' => $variant['option2'],
            'option3' => $variant['option3'],
            'store_created_at' => $variant['created_at'],
            'store_updated_at' => $variant['updated_at'],
            'taxable' => $variant['taxable'],
            'barcode' => $variant['barcode'],
            'grams' => $variant['grams'],
            'store_image_id' => $variant['image_id'],
            'weight' => $variant['weight'],
            'weight_unit' => $variant['weight_unit'],
            'inventory_item_id' => $variant['inventory_item_id'],
            'inventory_quantity' => $variant['inventory_quantity'],
            'old_inventory_quantity' => $variant['old_inventory_quantity'],
            'requires_shipping' => $variant['requires_shipping'],
            'admin_graphql_api_id' => $variant['admin_graphql_api_id']
        ]);
    }
}
