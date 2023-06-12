<?php

namespace App\Services\Webhook;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function delete(array $requestData): bool
    {
        try {
            $recordDelete = $this->productRepo->firstByFkWithTrashed('product_id', $requestData['id']);
            if ($recordDelete) {
                return (bool) $recordDelete->forceDelete();
            }

            return true;
        } catch (\Exception $error) {
            return false;
        }
    }
}
