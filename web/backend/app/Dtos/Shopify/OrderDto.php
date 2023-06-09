<?php

namespace App\Dtos\Shopify;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class OrderDto
{
    private const TAG_DELIMITER = ', ';

    public ?int $id;

    public ?CustomerDto $customer;

    public ?string $email;

    public ?string $name;

    public ?string $financial_status;

    public ?string $currency;

    public ?float $total_price;

    public Collection $line_items;

    public array $payment_gateway_names;

    public ?string $tags;

    public function __construct(array $order)
    {
        $this->id = $order['id'] ?? null;
        $this->customer = isset($order['customer']) && is_array($order['customer'])
            ? new CustomerDto($order['customer'])
            : null;
        $this->email = $order['email'] ?? null;
        $this->name = $order['name'] ?? null;
        $this->financial_status = $order['financial_status'] ?? null;
        $this->currency = $order['currency'] ?? null;
        $this->total_price = $order['total_price'] ?? null;
        $this->line_items = isset($order['line_items'])
            ? OrderItemDto::collections($order['line_items'])
            : collect([]);
        $this->payment_gateway_names = $order['payment_gateway_names'] ?? [];
        $this->tags = $order['tags'] ?? null;
    }

    public function hasTag(string $tag): bool
    {
        return \Str::contains($this->tags, $tag);
    }

    public function addTags(string ...$newTags): void
    {
        foreach ($newTags as $newTag) {
            if (! $this->hasTag($newTag)) {
                $this->tags = sprintf('%s, %s', $this->tags, $newTag);
            }
        }
    }

    public function toTagsArray(): array
    {
        return explode(self::TAG_DELIMITER, $this->tags);
    }

    public function firstTagMatch(string $regex): ?string
    {
        return Arr::first($this->toTagsArray(), function ($tag) use ($regex) {
            return preg_match($regex, $tag);
        });
    }
}
