<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\User\UpdateAvatarRequest;
use App\Http\Requests\API\V1\User\UpdateProfileRequest;
use App\Http\Resources\API\V1\UserResource;
use Domain\User\Jobs\UpdateAvatarJob;
use Domain\User\Services\UserService;
use Illuminate\Http\Request;
use Infrastructure\Shared\Responses\ApiResponse;

class UsersController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }

    public function profile(Request $request)
    {
        return ApiResponse::send(null,
            'success', [
                'user' => UserResource::make($request->user())->toArray($request)
            ]
        );
    }


    public function updateProfile(UpdateProfileRequest $request)
    {
        //Dispatch Update Profile Job

        //Todo: Changed it to be async in future but we have to think about the updated response for the frontend
        $this->userService->updateProfile($request->validated(), $request->user());

        $resource = UserResource::make($request->user())->toArray($request);
        $resource['is_profile_completed'] = true;
        return ApiResponse::send(null,
            'success', [
                'user' => $resource
            ]
        );
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        //Resize and save avatar
        $savedAvatar = $this->userService->updateAvatar($request);

        //Update the uploaded avatar in db using a background job
        UpdateAvatarJob::dispatch($savedAvatar, $request->user());

        //Assume the avatar updated in the job will be successful and return success message to the user
        return ApiResponse::send(__('messages.UpdateAvatarSuccess'));
    }

}
