<?php

namespace App\Http\Controllers\Webhook;

use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Webhook\ProductService;
use App\Http\Requests\Webhook\Shopify\CreateProductRequest;
use App\Http\Requests\Webhook\Shopify\UpdateProductRequest;
use App\Http\Requests\Webhook\Shopify\DeleteProductRequest;

class ShopifyProductController extends Controller
{
    use ResponseTrait;

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(CreateProductRequest $request): JsonResponse
    {
        try {
            // Handling for created product
            $data = $request->validated();
            return $this->success();
        } catch (\Exception $exception) {
            return $this->responseFailed($exception->getMessage());
        }
    }

    /**
     * @param UpdateProductRequest $request
     *
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request): JsonResponse
    {
        try {
            // Handling for updated product
            $data = $request->validated();
            return $this->success();
        } catch (\Exception $exception) {
            return $this->responseFailed($exception->getMessage());
        }
    }

    public function delete(DeleteProductRequest $request): JsonResponse
    {
        // Handling for deleted product
        $result = $this->productService->delete($request->validated());
        Log::info('Shopify Webhook Delete Product - Result: ', $result);
        return empty($result) ? $this->responseFailed() : $this->success();
    }
}
