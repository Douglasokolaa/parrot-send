<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use function PHPUnit\Framework\callback;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lga>
 */
class LgaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \JsonException
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
        $lgas = json_decode(file_get_contents(database_path('seeders/lgas.json')), true, 512, JSON_THROW_ON_ERROR);
        return $lgas['NG'];
    }
}
