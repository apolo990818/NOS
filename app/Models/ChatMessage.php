<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'guest_id',
        'user_id',
        'message',
        'from_admin',
    ];

    public $timestamps = true;

    protected $casts = [
        'from_admin' => 'boolean',
    ];
}
