<?php

namespace App\Dtos\Shopify;

use App\Dtos\AbstractDto;

class OrderItemDto extends AbstractDto
{
    public ?int $id;

    public ?int $variant_id;

    public ?int $product_id;

    public ?string $title;

    public ?string $name;

    public ?string $sku;

    public ?int $quantity;

    public ?float $price;

    public function __construct(array $itemData)
    {
        $this->id = $itemData['id'] ?? null;
        $this->variant_id = $itemData['variant_id'] ?? null;
        $this->product_id = $itemData['product_id'] ?? null;
        $this->title = $itemData['title'] ?? null;
        $this->name = $itemData['name'] ?? null;
        $this->sku = $itemData['sku'] ?? null;
        $this->quantity = $itemData['quantity'] ?? null;
        $this->price = $itemData['price'] ?? null;
    }
}
