<?php

namespace Database\Factories;

use App\Enums\PhoneBookStatus;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactGroup>
 */
class PhonebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'status' => $this->faker->randomElement(PhoneBookStatus::asValidationArray()),
            'team_id' => Team::factory()->create()->id
        ];
    }
}
