<?php

use App\Models\Company;
use App\Models\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('current_period');
            $table->string('next_period');

            $table->foreignIdFor(Subscription::class, 'current_subscription_id')
                ->constrained('subscriptions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Subscription::class, 'next_subscription_id')
                ->constrained('subscriptions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('start_date');
            $table->date('end_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_subscriptions');
    }
};
