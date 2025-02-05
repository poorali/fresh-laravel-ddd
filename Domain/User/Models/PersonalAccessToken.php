<?php

namespace Domain\User\Models;

use Domain\User\Events\UserWasLoggedInEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class PersonalAccessToken extends \Laravel\Sanctum\PersonalAccessToken
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'expires_at',
        'extra'
    ];
    protected $dispatchesEvents = ['updated' => UserWasLoggedInEvent::class];

}
