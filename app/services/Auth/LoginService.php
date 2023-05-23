<?php

namespace app\services\Auth;

use App\Http\Requests\LoginRequest;
use App\services\User\GetUserService;
use App\services\Auth\TokenService;
use Exception;

class LoginService
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $this->attempt($credentials);

        $user = GetUserService::find();

        return ['user' => $user ,'token' => TokenService::create_access_token($user)];

    }

    public function attempt(array $credentials)
    {
        if(!auth()->attempt($credentials))
            throw new Exception('failed');
    }
}
