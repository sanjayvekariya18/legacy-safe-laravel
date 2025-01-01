<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripeSubscriptionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phoneno' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'stripe_token' => 'required|string',
            'plan_id' => 'required|exists:plans,id',
        ];
    }
}
