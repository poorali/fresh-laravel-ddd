<?php

namespace Domain\User\Services;

use App\Http\Requests\API\V1\User\UpdateAvatarRequest;
use Domain\User\Models\Company;
use Domain\User\Models\User;
use Domain\User\Repository\CompanyRepository;
use Domain\User\Repository\UserRepository;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserService
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function updateProfile(array $creationData, User $user): User|false
    {
        try {
            //Mark user as profile completed
            if (!$user->update($creationData)) {
                throw new \Exception();
            }
            return $user;
        } catch (\Exception $e) {
            app('logs')($e);
            return false;
        }
    }

    public function updateAvatar(UpdateAvatarRequest $request): string|false
    {
        try {
            ///Get image, resize and upload it with users' uuid as the name of the file.
            $image = Image::read($request->image);
            $filename = $request->user()->uuid . '.png';
            $image->cover(150, 150)
                ->toPng()
                ->save(
                    Storage::disk('public')->path('avatars') . '/' . $filename
                );

            //Update avatar url in users db
            return $filename;
        } catch (\Exception $e) {
            app('logs')($e);
            return false;
        }
    }
}
