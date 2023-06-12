<?php

namespace App\Rules;

use App\Services\Webhook\WebhookService;
use Illuminate\Contracts\Validation\Rule;

class WebhookTopicRule implements Rule
{
    private $webhookService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(WebhookService $webhookService)
    {
        $this->webhookService = $webhookService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The topic has already been taken.';
    }
}
