<?php

namespace app\services\Auth;

use App\Models\User;

class TokenService
{
    public static function create_access_token(User $user) :string
    {
        return $user->createToken("token")->accessToken;
    }
}
