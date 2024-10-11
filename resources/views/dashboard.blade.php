@php use App\Enums\SubscriptionPeriodEnum; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Dashboard</title>
</head>
<body>
<div class="container">
    <div class="card" style="margin:50px auto">
        <div class="card-header">Subscription info:</div>
        <div class="card-body">
            <ul>
                <li>Company name: <b>{{$company->name}}</b></li>
                <li>Users number: <b>{{$company->number_of_users}}</b></li>
                <li>Current subscription: <b>{{$subscription->currentSubscription->name}}</b></li>
                <li>Current subscription payment frequency: <b>EVERY {{$subscription->current_period->name}}</b></li>
                <li>Current subscription period: <b>{{$subscription->start_date->format("d.m.Y")}}
                        - {{$subscription->end_date->format("d.m.Y")}}</b></li>
                <li>Future subscription: <b>{{$subscription->nextSubscription->name}}</b></li>
                <li>Future subscription payment frequency: <b>EVERY {{$subscription->next_period->name}}</b></li>

            </ul>
            <b>Change subscription</b>
            <form action="{{ route('subscription.update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="number_of_users">Number of users</label>
                    <input
                        type="number"
                        name="number_of_users"
                        id="number_of_users"
                        class="form-control"
                        value="{{$company->number_of_users}}"
                    >
                </div>
                <div class="form-group">
                    <label for="subscription">Subscription</label>
                    <select name="subscription_id" id="subscription" class="form-control">
                        @foreach($allSubscriptions as $subscriptionItem)
                            <option
                                value="{{$subscriptionItem->id}}"
                                @if($subscription->next_subscription_id == $subscriptionItem->id) selected @endif
                            >{{$subscriptionItem->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment_frequency">Payment frequency</label>
                    <select name="period" id="payment_frequency" class="form-control">
                        @foreach(SubscriptionPeriodEnum::cases() as $period)
                            <option
                                value="{{$period->name}}"
                                @if($subscription->next_period->name == $period->name) selected @endif
                            >{{$period->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" value="Save" />
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">All subscriptions</div>
        <div class="card-body d-flex justify-content-between">
            @foreach($allSubscriptions as $subscription)
                <div class="card mb-2">
                    <div class="card-header">{{$subscription->name}}</div>
                    <div class="card-body">
                        <ul>
                            <li>Name: <b>{{$subscription->name}}</b></li>
                            <li>Month price: <b>{{$subscription->month_price}} EUR per user</b></li>
                            <li>Year price: <b>{{$subscription->year_price}} EUR per user</b></li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
<script>

</script>
</html>
