<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Subscription;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    public function dashboard(): View
    {
        $allSubscriptions = Subscription::query()->get();
        $company = Company::query()->firstWhere('owner_id', auth()->id());
        $subscription = CompanySubscription::query()
            ->with(['currentSubscription', 'nextSubscription'])
            ->where('company_id', $company->id)
            ->first();

        return view('dashboard', compact('allSubscriptions', 'subscription', 'company'));
    }

    public function update(UpdateSubscriptionRequest $request): RedirectResponse
    {
        $company = Company::query()->firstWhere('owner_id', auth()->id());
        $company->number_of_users = $request->input('number_of_users');
        $company->save();

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

        return response()->redirectToRoute('dashboard');
    }
}
