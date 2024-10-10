<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    public function get(): JsonResponse
    {
        $subscriptions = Subscription::query()->get();

        return response()->json(['subscriptions' => $subscriptions]);
    }
    public function getCurrent(): JsonResponse
    {
        $userCompany = Company::query()->firstWhere('owner_id', auth()->id());
        $subscription = CompanySubscription::query()
            ->with(['currentSubscription', 'nextSubscription'])
            ->where('company_id', $userCompany->id)
            ->first();

        return response()->json(['subscription' => $subscription]);
    }

    public function update(UpdateSubscriptionRequest $request): JsonResponse
    {
        $company = Company::query()->firstWhere('owner_id', auth()->id());
        $subscription = Subscription::query()->find($request->input('subscription_id'));

        $companySubscription = CompanySubscription::query()->where('company_id', $company->id)->first();
        if($companySubscription){
            $companySubscription->update([
                'next_subscription_id' => $subscription->id,
                'next_period' => $request->input('period'),
            ]);
        } else {
            $period = $request->input('period');
            CompanySubscription::query()->create([
                'company_id' => $company->id,
                'current_period' => $period,
                'next_period' => $period,
                'current_subscription_id' => $subscription->id,
                'next_subscription_id' => $subscription->id,
                'start_date' => now(),
                'end_date' => now()->addMonths($period == 'month' ? 1 : 12),
            ]);
        }

        return response()->json(['subscription' => $companySubscription]);
    }
}
