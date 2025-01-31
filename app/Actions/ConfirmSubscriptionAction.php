<?php

namespace App\Actions;

use App\Enums\SubscriptionStatusEnum;
use App\Models\Subscription;

final class ConfirmSubscriptionAction
{
    public function __construct(private readonly string $token) {}

    public function handle()
    {
        $subscription = Subscription::whereToken($this->token)->firstOrFail();
        $subscription->update(['subscribed_at' => now(), 'status' => SubscriptionStatusEnum::SUBSCRIBED]);
    }
}
