<?php

namespace App\Models;

use App\Enums\ContactGroupStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $casts = [
        'status' => ContactGroupStatus::class
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
