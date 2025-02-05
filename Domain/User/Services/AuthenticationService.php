<?php

namespace Domain\User\Services;

use App\Http\Requests\API\V1\User\AuthenticationRequest;
use Domain\User\Repository\PersonalAccessTokenRepository;
use Domain\User\Repository\UserRepository;

/**
 * Authentication Service
 *
 * This service is responsible for authenticating users and generating authentication tokens.
 *
 * It uses the UserRepository to find or create a user instance, and then generates an authentication token
 * using the createToken method. The token is then updated with extra data using the PersonalAccessTokenRepository.
 *
 * @package Domain\User\Services
 */
class AuthenticationService
{
    public function __construct(private UserRepository $repository, private PersonalAccessTokenRepository $tokenRepository)
    {
    }

    /**
     * Authenticate a user and generate an authentication token
     *
     * @param AuthenticationRequest $request
     * @return array|false
     *
     * @throws \Exception
     */
    public function authenticate(AuthenticationRequest $request): array|false
    {
        try {
            app('logs')(['request' => $request->validated()]);
            // Create User Instance
            $user = $this->repository->findOrCreate($request->validated());
            if (!$user) {
                throw new \Exception();
            }

            //Login and create Authorization token

            $token = $user->createToken($request->input('social_driver'));
            if(!$token){
                throw new \Exception();
            }

            //Update extra info inside token model
            if(!$this->tokenRepository->updateExtraData($token->accessToken, ['ip'=> $request->getClientIp(), 'agent' => $request->userAgent()])){
                throw new \Exception();
            }
            return ['user' => $user, 'token' => $token->plainTextToken];
        } catch (\Exception $e) {
            app('logs')($e);
            return false;
        }
    }
}
