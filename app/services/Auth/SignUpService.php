<?php

namespace app\services\Auth;

use App\Http\Requests\StoreUserRequest;
use App\services\User\StoreUserService;
use App\services\Auth\TokenService;
use App\services\Wallet\DefaultBalanceService;


class SignUpService
{
    public function create(StoreUserRequest $request)
    {
        $user = StoreUserService::create($request);
        DefaultBalanceService::set($user->wallet());
        $token = TokenService::create_access_token($user);
        return
        [
            'token' => $token,
            'user' => $user
        ];
    }
}
