<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Services\CustomerService;

class CustomersController extends Controller
{
    use ResponseTrait;

    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function sync()
    {
        $this->customerService->syncShopifyCustomers();
        return response()->json(['message' => 'Customers sync successful']);
    }
}
