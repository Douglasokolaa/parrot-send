<?php

namespace Database\Factories;

use App\Models\Lga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return $this->faker->randomElement($this->list());
    }

    /**
     * @throws \JsonException
     */
    public function list(): array
    {
        return json_decode(file_get_contents(database_path('seeders/communities.json')), true, 512, JSON_THROW_ON_ERROR);
    }
}
