<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enabled'
    ];

    protected $casts = [
        'enabled' => 'boolean'
    ];

    protected $attributes = [
        'enabled' => false,
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
