<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\OrderService;

class OrdersController extends Controller
{
    use ResponseTrait;

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function sync()
    {
        $this->orderService->syncShopifyOrders();
        return response()->json(['message' => 'Order sync successful']);
    }
}
