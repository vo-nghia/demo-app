<?php

namespace App\Services\Webhook;

use Illuminate\Support\Arr;
use App\Repositories\WebhookRepository;
use App\Repositories\Shopify\ShopifyWebhookRepository;

class WebhookService
{
    private $webhookRepo;
    private $shopifyWebhookRepo;

    public function __construct(
        WebhookRepository $webhookRepo,
        ShopifyWebhookRepository $shopifyWebhookRepo
    ) {
        $this->webhookRepo = $webhookRepo;
        $this->shopifyWebhookRepo = $shopifyWebhookRepo;
    }

    public function create(array $requestData)
    {
        $requestData = Arr::only($requestData, ['topic', 'format', 'fields', 'address']);
        $shopifyResponse = $this->shopifyWebhookRepo->create($requestData);
        if (is_null($shopifyResponse)) {
            return false;
        }
        $shopifyWebHook = $shopifyResponse['webhook'];
        foreach ($shopifyWebHook as $element => $webhookElement) {
            if (is_array($shopifyWebHook[$element])) {
                $shopifyWebHook[$element] = json_encode($webhookElement);
            }
        }
        return $this->webhookRepo->create($shopifyWebHook);
    }

    public function getFiltered(array $requestData)
    {
        return $this->webhookRepo->all($requestData);
    }
}
