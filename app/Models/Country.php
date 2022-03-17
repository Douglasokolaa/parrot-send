<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'un_member' => 'boolean'
    ];

    public function phone_code(): Attribute
    {
        return new Attribute(
            get: fn($value) => str($value)->split('+')->first()
        );
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class, 'country_iso2', 'iso2');
    }
}
