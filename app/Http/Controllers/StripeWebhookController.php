<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;

class StripeWebhookController extends WebhookController
{
    public function handleWebhook(Request $request)
    {
        Log::info('Webhook received:', $request->all());
        return parent::handleWebhook($request);
    }
}
