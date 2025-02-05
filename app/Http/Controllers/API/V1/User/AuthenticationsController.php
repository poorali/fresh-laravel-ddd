<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\User\AuthenticationRequest;
use App\Http\Resources\API\V1\UserResource;
use Domain\User\Services\AuthenticationService;
use Infrastructure\Shared\Responses\ApiResponse;

class AuthenticationsController extends Controller
{
    public function __construct(protected AuthenticationService $authenticationService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(AuthenticationRequest $request)
    {

        $authenticate = $this->authenticationService->authenticate($request);
        if (!$authenticate) {
            return ApiResponse::send(null, 'error');
        }
        return ApiResponse::send(__('messages.UserLoggedInSuccess'),
            'success',
            [
                'token' => $authenticate['token'],
                'user' => UserResource::make($authenticate['user'])->toArray($request)
            ]);
    }
}
