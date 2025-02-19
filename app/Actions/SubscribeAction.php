<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\SubscriptionStatusEnum;
use App\Exceptions\AlreadySubscribedException;
use App\Models\EmailList;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\VerifySubscriptionNotification;
use Illuminate\Support\Str;

final class SubscribeAction
{
    public function __construct(private readonly int $emailListId, private readonly string $email) {}

    public function handle()
    {
        $emailList = EmailList::findOrFail($this->emailListId);
        $user = User::firstOrCreate(['email' => $this->email], ['email' => $this->email, 'name' => 'User']);

        if ($user->isInEmailList($emailList)) {
            throw new AlreadySubscribedException('You are already part of this email list');
        }

        $payload = [
            'user_id' => $user->id,
            'email_list_id' => $emailList->id,
            'status' => SubscriptionStatusEnum::PENDING,
        ];
        $subscription = Subscription::updateOrCreate($payload, $payload + ['token' => Str::random(6)]);

        $user->notify(new VerifySubscriptionNotification($subscription));
    }
}
