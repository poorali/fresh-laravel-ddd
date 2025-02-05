<?php

namespace Domain\User\Repository;

use Domain\User\Models\User;
use Illuminate\Support\Str;

class UserRepository
{
    public function __construct(public User $model)
    {
    }


    public function findOrCreate(array $creationData): ?User
    {
        try {
            $creationData['uuid'] = Str::uuid();
            return $this->model->firstOrCreate([
                'email' => $creationData['email'],
                'social_driver' => $creationData['social_driver']
            ], array_merge($creationData, ['uuid' => Str::uuid()]));
        } catch (\Exception $e) {
            app('logs')($e);
            return null;
        }
    }

    public function setAvatar(string $filename): string|false
    {
        return $this->model->update(['avatar' => asset('/storage/avatars/' . $filename)]);
    }



    public function findByEmail(string $email): User|null
    {
        return $this->model->where('email', $email)->get()->first() ?? null;
    }

}
