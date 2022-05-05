<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\State>
 */
class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return $this->faker->randomElement($this->statesList());
    }

    /**
     * @throws \JsonException
     */
    public function statesList($country = null): array
    {
        $states = json_decode(file_get_contents(database_path('seeders/states.json')), true, 512, JSON_THROW_ON_ERROR);
        return collect($states)
            ->flatMap(fn(array $states, $key) => collect($states)->map(fn(array $state) => [
                ...$state,
                'country_iso2' => $key,
                'other_name'   => str($state['name'])->remove(' State')->toString()
            ]))
            ->filter(function ($state) use ($country) {
                if (!empty($country)) {
                    return strtolower($state['country_iso2']) === strtolower($country);
                }
                return true;
            })
            ->toArray();
    }
}
