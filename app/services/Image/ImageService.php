<?php

namespace App\Services\Image;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use test;

class ImageService
{
    public static function upload_image($images,$type,$is_user)
    {
        $paths = [];

        if($is_user)
        {
            $paths = $images->store($type, 'public');
        }
        else
        {
            foreach($images as $image)
            {
                $paths[] = $image->store($type, 'public');
            }
        }

        return $paths;
    }

    public static function default()
    {
        // return 'profile/default.jpg';
    }


}


