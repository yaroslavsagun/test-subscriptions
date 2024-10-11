<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subscription_id' => 'required|exists:subscriptions,id',
            'period' => 'required|in:MONTH,YEAR',
            'number_of_users' => 'integer|min:1',
        ];
    }
}
