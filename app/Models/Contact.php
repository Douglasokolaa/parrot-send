<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'phone_national',
        'phone_e164',
        'phone',
        'address',
        'state',
        'unit',
        'city',
        'last_name',
        'lga',
        'business',
        'country',
        'region',
        'phone_country',
        'team_id',
        'phonebook_id'
    ];

    protected $casts = [
        'phone_e164' => E164PhoneNumberCast::class,
    ];

    protected static function booted(): void
    {
        static::saving(function (Contact $contact) {
            if ($contact->phone && $contact->isDirty('phone')) {
                $contact->phone_national = preg_replace('[^0-9]', '', phone($contact->phone, $contact->phone_country)->formatNational());
                $contact->phone_e164 = phone($contact->phone, $contact->phone_country)->formatE164();
                $contact->phone = preg_replace('[^0-9]', '', $contact->phone);
            }
        });
    }


    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function phonebook(): BelongsTo
    {
        return $this->belongsTo(Phonebook::class);
    }
}
