<?php

namespace App\Http\Requests\Webhook;

use App\Enums\WebhookEventTopic;
use App\Enums\WebhookFormatType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebhookUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'format' => [
                'required',
                Rule::in(WebhookFormatType::getValues()),
            ],
            'topic' => [
                'required',
                'string',
                'exists:webhooks,topic',
                Rule::in(WebhookEventTopic::getValues()),
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
