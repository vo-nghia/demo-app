<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\Order;

class OrderRepository extends AbstractRepository
{
    public function modelClass(): string
    {
        return Order::class;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function count()
    {
        return Order::count();
    }

    public function getList()
    {
        return Order::all();
    }
}
