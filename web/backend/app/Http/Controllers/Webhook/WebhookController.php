<?php

namespace App\Http\Controllers\Webhook;

use App\Traits\ResponseTrait;
use App\Enums\HttpResponseCode;
use App\Http\Controllers\Controller;
use App\Services\Webhook\WebhookService;
use App\Http\Requests\Webhook\WebhookStoreRequest;
use App\Http\Requests\Webhook\WebhookFilterRequest;

class WebhookController extends Controller
{
    use ResponseTrait;

    private $webhookService;

    public function __construct(WebhookService $webhookService) {
        $this->webhookService = $webhookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WebhookFilterRequest $request)
    {
        $webHooks = $this->webhookService->getFiltered($request->validated());
        return $this->success(['data' => $webHooks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(WebhookStoreRequest $request)
    {
        $result = $this->webhookService->create($request->validated());
        return $result ? $this->success() : $this->error(HttpResponseCode::HTTP_BAD_REQUEST);
    }
}
