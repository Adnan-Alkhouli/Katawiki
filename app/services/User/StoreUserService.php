<?php

namespace app\services\User;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\Image\ImageService;

class StoreUserService
{
    public static function create(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        if($request->hasFile('image'))
            $data['image'] = ImageService::upload_image($request->file('image'),'profile',true);

        $user = User::create($data);
        return $user;
    }
}
