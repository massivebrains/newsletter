<?php

namespace Database\Factories;

use App\Enums\EmailListStatusEnum;
use App\Enums\TemplateEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailList>
 */
final class EmailListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'template' => TemplateEnum::DEFAULT,
            'status' => EmailListStatusEnum::ACTIVE,
        ];
    }
}
