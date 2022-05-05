<?php

namespace Database\Factories;

use App\Enums\MessageStatus;
use App\Models\Contact;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->withPersonalTeam()->create();
        $team = $user->personalTeam();
        $contact = Contact::factory()->create(['team_id' => $team->id]);
        return [
            'team_id'      => $team->id,
            'sender_id'    => fn() => Sender::factory()->create(['team_id' => $team->id]),
            'contact_id'   => $contact->id,
            'phone_e164'   => $contact->phone_e164,
            'sent_by'      => $user->id,
            'receiver'     => $contact->phone,
            'message'      => $this->faker->text,
            'status'       => MessageStatus::getRandomInstance(),
            'scheduled_at' => $this->faker->dateTime('next week')
        ];
    }
}
