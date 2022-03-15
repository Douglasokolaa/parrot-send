<?php

namespace Database\Factories;

use App\Models\Phonebook;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Propaganistas\LaravelPhone\PhoneNumber;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phone = PhoneNumber::make((new \Faker\Provider\en_US\PhoneNumber($this->faker))->phoneNumber(), 'US');
        return [
            'first_name'     => $this->faker->firstName,
            'last_name'      => $this->faker->lastName,
            'team_id'        => Team::factory()->create()->id,
            'phone_e164'     => $this->faker->e164PhoneNumber,
            'lga'            => $this->faker->city,
            'unit'           => $this->faker->word,
            'city'           => $this->faker->city,
            'country'        => $this->faker->country,
            'email'          => $this->faker->safeEmail,
            'address'        => $this->faker->address,
            'region'         => $this->faker->city,
            'business'       => $this->faker->company,
            'state'          => $this->faker->city,
            'phone_country'  => $phone->getCountry(),
            'phone'          => $phone->formatNational(),
            'phone_national' => $phone->formatNational(),
            'phonebook_id' => Phonebook::factory()->create()->id
        ];
    }
}
