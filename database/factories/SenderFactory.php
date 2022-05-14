<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sender>
 */
class SenderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => str($this->faker->userName)->remove(['.','-','_'])->substr(0, 10)->toString(),
            'enabled' => $this->faker->boolean,
            'team_id' => fn() => Team::factory()->create()->id
        ];
    }
}
