<?php

namespace App\Repositories;

use App\Models\Webhook;

class WebhookRepository extends AbstractRepository
{
    public function modelClass(): string
    {
        return Webhook::class;
    }
}
