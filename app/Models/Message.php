<?php

namespace App\Models;

use App\Enums\MessageStatus;
use App\Enums\MessageRoute;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_id',
        'receiver',
        'scheduled_at',
        'phone_e164',
        'status',
        'sent_by',
        'contact_id',
        'team_id',
        'cost',
        'pages',
        'sent_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at'      => 'immutable_datetime',
        'status'       => MessageStatus::class,
        'route'        => MessageRoute::class,
    ];

    protected $attributes = [
        'route'    => MessageRoute::generic,
        'provider' => 'termii'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Sender::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function sent_by(): Attribute
    {
        return Attribute::set(static fn($value) => $value ?? auth()->id());
    }
}
