<?php

namespace Tests\Feature\Actions;

use App\Actions\SubscribeAction;
use App\Exceptions\AlreadySubscribedException;
use App\Models\EmailList;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\VerifySubscriptionNotification;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

final class SubscribeActionTest extends TestCase
{
    use WithFaker;

    public function test_handle_success(): void
    {
        Notification::fake();

        $email = $this->faker->email;
        $emailListId = EmailList::factory()->create()->id;

        (new SubscribeAction($emailListId, $email))->handle();

        $user = User::whereEmail($email)->first();

        $this->assertDatabaseHas('users', ['email' => $email]);
        $this->assertDatabaseHas('subscriptions', ['email_list_id' => $emailListId, 'user_id' => $user->id]);

        Notification::assertSentTo($user, VerifySubscriptionNotification::class);
    }

    public function test_handle_throws_when_user_already_subscribed(): void
    {
        Notification::fake();

        $email = $this->faker->email;
        $user = User::factory()->create(['email' => $email]);
        $emailListId = EmailList::factory()->create()->id;
        Subscription::factory()->create(['email_list_id' => $emailListId, 'user_id' => $user->id]);

        $this->expectException(AlreadySubscribedException::class);

        (new SubscribeAction($emailListId, $email))->handle();

        Notification::assertNotSentTo($user, VerifySubscriptionNotification::class);
    }
}
