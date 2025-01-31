<?php

namespace Database\Factories;

use App\Enums\SubscriptionStatusEnum;
use App\Models\EmailList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
final class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['email' => $this->faker->unique()->safeEmail])->id,
            'email_list_id' => EmailList::factory(),
            'status' => SubscriptionStatusEnum::PENDING,
            'token' => $this->faker->unique()->regexify('[A-Za-z0-9]{6}'),
            'subscribed_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
