<?php

namespace App\Http\Requests\Webhook;

use App\Enums\WebhookEventTopic;
use App\Enums\WebhookFormatType;
use App\Rules\WebhookTopicRule;
use App\Services\Webhook\WebhookService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebhookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(WebhookService $webhookService): array
    {
        return [
            'topic' => [
                'required',
                'string',
                'unique:webhooks,topic',
                Rule::in(WebhookEventTopic::getValues()),
                new WebhookTopicRule($webhookService),
            ],
            'format' => [
                'required',
                Rule::in(WebhookFormatType::getValues()),
            ],
            'address' => [
                'required',
                'string',
                'max:255'
            ],
            'fields' => 'nullable|string|max:255',
        ];
    }
}
