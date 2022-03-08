<?php

namespace App\Models;

use App\Enums\ContactGroupStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
