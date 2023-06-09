<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\Customer;

class CustomerRepository extends AbstractRepository
{
    public function modelClass(): string
    {
        return Customer::class;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function count()
    {
        return Customer::count();
    }

    public function getList()
    {
        return Customer::all();
    }
}
