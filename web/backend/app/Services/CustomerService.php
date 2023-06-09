<?php

namespace App\Services;

use App\Repositories\Shopify\ShopifyCustomerRepository;
use App\Repositories\CustomerRepository;

class CustomerService
{
    private $shopifyCustomerRepo;
    private $customerRepo;

    public function __construct(
        ShopifyCustomerRepository $shopifyCustomerRepo,
        CustomerRepository $customerRepo,
    ) {
        $this->shopifyCustomerRepo = $shopifyCustomerRepo;
        $this->customerRepo = $customerRepo;
    }

    public function syncShopifyCustomers()
    {
        return $this->shopifyCustomerRepo->sync();
    }
}
