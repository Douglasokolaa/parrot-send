<?php

namespace App\Models;

use App\Enums\PhonebookStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phonebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted()
    {
        self::creating(fn(self $phonebook) => $phonebook->slugIt());
    }

    protected $casts = [
        'status' => PhonebookStatus::class
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    private function slugIt(): static
    {
        $this->slug = str($this->name)->slug();
        return $this;
    }
}
