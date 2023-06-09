<?php

namespace App\Dtos\Shopify;

use App\Dtos\AbstractDto;
use App\Enums\ShopifyCustomerState;

class CustomerDto extends AbstractDto
{
    public ?int $id;

    public ?string $email;

    public ?string $first_name;

    public ?string $last_name;

    public ?string $full_name;

    public ?ShopifyCustomerState $state;

    public function __construct(array $customerData)
    {
        $this->id = $customerData['id'] ?? null;
        $this->email = $customerData['email'] ?? null;
        $this->first_name = $customerData['first_name'] ?? null;
        $this->last_name = $customerData['last_name'] ?? null;
        $this->full_name = $this->getFullName($this->first_name, $this->last_name);
        $this->state = $customerData['state'] ? ShopifyCustomerState::fromValue($customerData['state']) : null;
    }

    protected function getFullName(?string $firstName, ?string $lastName): string
    {
        if (! $firstName && ! $lastName) {
            return '';
        }
        if ($firstName && ! $lastName) {
            return $firstName;
        }
        if (! $firstName && $lastName) {
            return $lastName;
        }

        return $lastName . ' ' . $firstName;
    }
}
