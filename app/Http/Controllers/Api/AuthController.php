<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\UserRepository;
use App\Http\Resources\User\User as UserResource;
use Validator;
use App\Models\User;
use Session;

class AuthController extends ApiController {

    function validation(Request $request)
    {
        $input = $request->all();
        $phoneNum = $input['phone_num'];
        $user = User::firstOrCreate(['phone_number' => $phoneNum]);
        if($user)
        {
            Session::put('phoneNum', $phoneNum);
            $user->sendToken();
            $webToken = Session::get('token');
            return $this->apiResponseSuccess($webToken, 'User retrieved successfully.');
            //return $this->apiResponse200();
        } else
        {
            return $this->apiResponseError('User not found or bad number.');
        }

    }

    function login(Request $request)
    {
        $input = $request->all();
        $token = $input['token'];
        $phoneNum = Session::get('phoneNum');
        $user = User::where('phone_number', '=', $phoneNum)->firstOrFail();
        if($user && $user->validateToken($token)) {
            $id = $user['id'];
            $directory = "/user_files_" . $id;
            Storage::disk('public')->makeDirectory($directory);
            $success['token'] =  $user->createToken('BobApp')->accessToken;
            $success['user'] =  new UserResource($user);
            return $this->apiResponseSuccess($success, 'User connected successfully.');
        } else {
            return $this->apiResponseError('Wrong token or phone number.');
        }
    }

}