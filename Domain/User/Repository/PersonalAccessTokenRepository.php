<?php

namespace Domain\User\Repository;

use Domain\User\Models\PersonalAccessToken;

class PersonalAccessTokenRepository
{
    public function __construct(public PersonalAccessToken $model)
    {
    }


    public function updateExtraData($token, array $extra): bool
    {
        return $token->update(['extra' => $extra]);
    }

}
