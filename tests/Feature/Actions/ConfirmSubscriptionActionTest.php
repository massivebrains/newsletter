<?php

namespace Tests\Feature\Actions;

use App\Actions\ConfirmSubscriptionAction;
use App\Enums\SubscriptionStatusEnum;
use App\Models\Subscription;
use Tests\TestCase;

final class ConfirmSubscriptionActionTest extends TestCase
{
    public function test_handle(): void
    {
        $subscription = Subscription::factory()->create(['subscribed_at' => null, 'status' => SubscriptionStatusEnum::PENDING]);

        (new ConfirmSubscriptionAction($subscription->token))->handle();

        $this->assertEquals(SubscriptionStatusEnum::SUBSCRIBED, $subscription->refresh()->status);
    }
}
