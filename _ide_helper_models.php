<?php

// @formatter:off

/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {

    /**
     * App\Models\Community
     *
     * @method static \Database\Factories\CommunityFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Community newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Community newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Community query()
     */
    class Community extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Contact
     *
     * @property int $id
     * @property string $first_name
     * @property string|null $last_name
     * @property mixed $phone_e164
     * @property string $phone_national
     * @property string $phone
     * @property string $phone_country
     * @property int $team_id
     * @property int $phonebook_id
     * @property string|null $email
     * @property string|null $address
     * @property string|null $city
     * @property string|null $unit
     * @property string|null $lga
     * @property string|null $state
     * @property string|null $region
     * @property string|null $country
     * @property string|null $business
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Phonebook|null $phonebook
     * @property-read \App\Models\Team|null $team
     * @method static \Database\Factories\ContactFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBusiness($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCity($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCountry($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFirstName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLastName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLga($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhoneCountry($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhoneE164($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhoneNational($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhonebookId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereRegion($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereState($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUnit($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
     */
    class Contact extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Country
     *
     * @property int $id
     * @property string $name
     * @property string $iso2
     * @property string $phone_code
     * @property string $long_name
     * @property string $iso3
     * @property string $cctld
     * @property string $numcode
     * @property bool $un_member
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\State[] $states
     * @property-read int|null $states_count
     * @method static \Database\Factories\CountryFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Country query()
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereCctld($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso3($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereLongName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereNumcode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country wherePhoneCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereUnMember($value)
     */
    class Country extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Lga
     *
     * @property int $id
     * @property string $name
     * @property string|null $code
     * @property int $state_id
     * @property string $country_iso2
     * @property string $state_code
     * @property string|null $other_name
     * @method static \Database\Factories\LgaFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Lga newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Lga query()
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereCountryIso2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereOtherName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereStateId($value)
     */
    class Lga extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Membership
     *
     * @property int $id
     * @property int $team_id
     * @property int $user_id
     * @property string|null $role
     * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereRole($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUserId($value)
     */
    class Membership extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Message
     *
     * @property int $id
     * @property int $sender_id
     * @property int|null $contact_id
     * @property int $sent_by
     * @property int $team_id
     * @property string $message
     * @property string $receiver
     * @property string $phone_e164
     * @property \App\Enums\MessageStatus $status
     * @property \Illuminate\Support\Carbon $scheduled_at
     * @property int|null $pages
     * @property \Carbon\CarbonImmutable|null $sent_at
     * @property mixed|null $response
     * @property string|null $cost
     * @property string|null $channel_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Sender $sender
     * @property-read \App\Models\Team $team
     * @method static \Database\Factories\MessageFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Message query()
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereChannelId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereContactId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereCost($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message wherePages($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message wherePhoneE164($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereReceiver($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereResponse($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereScheduledAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereSenderId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereSentAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereSentBy($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
     */
    class Message extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Phonebook
     *
     * @property int $id
     * @property int $team_id
     * @property string $name
     * @property \App\Enums\PhoneBookStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
     * @property-read int|null $contacts_count
     * @property-read \App\Models\Team $team
     * @method static \Database\Factories\PhonebookFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook query()
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Phonebook whereUpdatedAt($value)
     */
    class Phonebook extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Sender
     *
     * @property int $id
     * @property string $name
     * @property bool $enabled
     * @property int $team_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Team $team
     * @method static \Database\Factories\SenderFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Sender newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Sender newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Sender query()
     * @method static \Illuminate\Database\Eloquent\Builder|Sender whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Sender whereEnabled($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Sender whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Sender whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Sender whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Sender whereUpdatedAt($value)
     */
    class Sender extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\State
     *
     * @property int $id
     * @property string $name
     * @property string $code
     * @property string $country_iso2
     * @property string|null $other_name
     * @method static \Database\Factories\StateFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|State query()
     * @method static \Illuminate\Database\Eloquent\Builder|State whereCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryIso2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereOtherName($value)
     */
    class State extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Team
     *
     * @property int $id
     * @property int $user_id
     * @property string $name
     * @property bool $personal_team
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
     * @property-read int|null $contacts_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
     * @property-read int|null $messages_count
     * @property-read \App\Models\User|null $owner
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phonebook[] $phonebooks
     * @property-read int|null $phonebooks_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sender[] $senders
     * @property-read int|null $senders_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TeamInvitation[] $teamInvitations
     * @property-read int|null $team_invitations_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
     * @property-read int|null $users_count
     * @method static \Database\Factories\TeamFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Team query()
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TeamInvitation
 *
 * @property int $id
 * @property int $team_id
 * @property string $email
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereUpdatedAt($value)
 */
	class TeamInvitation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

