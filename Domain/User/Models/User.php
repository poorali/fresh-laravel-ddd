<?php

namespace Domain\User\Models;

use Domain\User\Events\UserWasRegisteredEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Infrastructure\Shared\Concerns\HasEncodedId;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasEncodedId;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'summary',
        'gender',
        'timezone',
        'social_driver',
        'avatar',
        'password',
        'uuid',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'referer_id'
    ];


    /**
     * When CRUD actions are applying, It runs specific Events
     * @var array<string, string>
     */
    protected $dispatchesEvents = ['created' => UserWasRegisteredEvent::class];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $appends = ['fullname'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function getFullnameAttribute(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }


}
